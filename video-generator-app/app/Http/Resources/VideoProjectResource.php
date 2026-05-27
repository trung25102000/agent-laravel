<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoProjectResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'keyword' => $this->keyword,
            'content_brief' => $this->content_brief,
            'tone' => $this->tone,
            'duration_seconds' => $this->duration_seconds,
            'platform' => $this->platform,
            'language' => $this->language,
            'status' => $this->status->value,
            'progress_percent' => $this->progress_percent,
            'error_message' => $this->error_message,
            'script_content' => $this->script_content,
            'output_ready' => $this->rendered_video_path !== null,
            'preview_url' => $this->when(
                $this->rendered_video_path !== null,
                fn (): string => route('video-projects.preview', $this->resource)
            ),
            'download_url' => $this->when(
                $this->rendered_video_path !== null,
                fn (): string => route('video-projects.download', $this->resource)
            ),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
