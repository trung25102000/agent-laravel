<?php

namespace App\Services\Rendering;

use App\DTOs\RenderedVideo;
use App\Models\VideoProject;
use App\Services\Rendering\Contracts\RenderProviderInterface;
use Illuminate\Support\Facades\Storage;

class MockRenderProvider implements RenderProviderInterface
{
    public function render(VideoProject $videoProject): RenderedVideo
    {
        $disk = config('video_pipeline.storage.output_disk');
        $path = "videos/video-projects/{$videoProject->id}/output.txt";

        Storage::disk($disk)->put($path, implode("\n", [
            "Mock rendered video for project {$videoProject->id}",
            "Keyword: {$videoProject->keyword}",
            "Script: {$videoProject->script_content}",
            "Audio: {$videoProject->audio_path}",
            "Subtitle: {$videoProject->subtitle_path}",
            'Assets: '.$videoProject->assets()->pluck('path')->implode(', '),
        ]));

        return new RenderedVideo($disk, $path, 'text/plain');
    }
}
