<?php

namespace App\Jobs;

use App\Models\VideoProject;
use App\Services\VideoProjectStatusService;
use App\Services\VideoRenderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class RenderVideoJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 2;

    public int $timeout = 1200;

    public function __construct(
        public readonly int $videoProjectId,
    ) {
        $this->onQueue(config('video_pipeline.queue'));
    }

    public function handle(VideoRenderService $videoRenderService): void
    {
        $videoProject = VideoProject::query()->findOrFail($this->videoProjectId);

        $videoRenderService->render($videoProject);
    }

    public function failed(Throwable $exception): void
    {
        $videoProject = VideoProject::query()->find($this->videoProjectId);

        if (! $videoProject) {
            return;
        }

        app(VideoProjectStatusService::class)->fail($videoProject, 'Render job failed.');

        Log::error('RenderVideoJob failed.', [
            'video_project_id' => $videoProject->id,
            'user_id' => $videoProject->user_id,
            'step' => 'rendering',
            'exception' => $exception::class,
        ]);
    }
}
