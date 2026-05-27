<?php

namespace App\Services;

use App\Enums\VideoAssetTypeEnum;
use App\Enums\VideoProjectStatusEnum;
use App\Events\VideoProjectCompleted;
use App\Exceptions\PipelineException;
use App\Models\VideoProject;
use App\Services\Rendering\Contracts\RenderProviderInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Throwable;

class VideoRenderService
{
    public function __construct(
        private readonly RenderProviderInterface $renderProvider,
    ) {
    }

    public function render(VideoProject $videoProject): VideoProject
    {
        $videoProject->forceFill([
            'status' => VideoProjectStatusEnum::Rendering,
            'progress_percent' => max($videoProject->progress_percent, 90),
            'error_message' => null,
        ])->save();

        try {
            $renderedVideo = $this->renderProvider->render($videoProject->refresh());
        } catch (Throwable $exception) {
            app(VideoProjectStatusService::class)->fail($videoProject, 'Render step failed.');

            Log::error('Video render failed.', [
                'video_project_id' => $videoProject->id,
                'user_id' => $videoProject->user_id,
                'step' => 'rendering',
                'provider' => $this->renderProvider::class,
                'exception' => $exception::class,
            ]);

            throw new PipelineException('Video render failed.', previous: $exception);
        }

        $completedProject = DB::transaction(function () use ($videoProject, $renderedVideo): VideoProject {
            $videoProject->forceFill([
                'status' => VideoProjectStatusEnum::Completed,
                'progress_percent' => 100,
                'rendered_video_path' => $renderedVideo->path,
            ])->save();

            $videoProject->assets()->updateOrCreate(
                [
                    'video_scene_id' => null,
                    'type' => VideoAssetTypeEnum::Output,
                ],
                [
                    'disk' => $renderedVideo->disk,
                    'path' => $renderedVideo->path,
                    'source' => 'mock',
                    'metadata' => [
                        'mime_type' => $renderedVideo->mimeType,
                    ],
                ]
            );

            return $videoProject->refresh();
        });

        event(new VideoProjectCompleted($completedProject));

        return $completedProject;
    }
}
