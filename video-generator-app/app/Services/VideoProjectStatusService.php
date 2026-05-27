<?php

namespace App\Services;

use App\Enums\VideoProjectStatusEnum;
use App\Models\VideoProject;

class VideoProjectStatusService
{
    public function update(
        VideoProject $videoProject,
        VideoProjectStatusEnum $status,
        int $progressPercent,
        ?string $errorMessage = null,
    ): VideoProject {
        $videoProject->forceFill([
            'status' => $status,
            'progress_percent' => max(0, min(100, $progressPercent)),
            'error_message' => $errorMessage,
        ])->save();

        return $videoProject->refresh();
    }

    public function fail(VideoProject $videoProject, string $message): VideoProject
    {
        return $this->update(
            $videoProject,
            VideoProjectStatusEnum::Failed,
            $videoProject->progress_percent,
            $message,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(VideoProject $videoProject): array
    {
        return [
            'id' => $videoProject->id,
            'status' => $videoProject->status->value,
            'progress_percent' => $videoProject->progress_percent,
            'error_message' => $videoProject->error_message,
            'output_ready' => $videoProject->rendered_video_path !== null,
        ];
    }
}
