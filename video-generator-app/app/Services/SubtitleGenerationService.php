<?php

namespace App\Services;

use App\Models\VideoProject;
use Illuminate\Support\Facades\Storage;

class SubtitleGenerationService
{
    public function generate(VideoProject $videoProject): VideoProject
    {
        $disk = config('video_pipeline.storage.disk');
        $path = "subtitles/video-projects/{$videoProject->id}/subtitles.srt";

        Storage::disk($disk)->put($path, $this->toSrt($videoProject));

        $videoProject->forceFill([
            'subtitle_disk' => $disk,
            'subtitle_path' => $path,
            'progress_percent' => max($videoProject->progress_percent, 70),
        ])->save();

        return $videoProject->refresh();
    }

    public function toSrt(VideoProject $videoProject): string
    {
        $cursor = 0.0;

        return $videoProject->scenes
            ->values()
            ->map(function ($scene, int $index) use (&$cursor): string {
                $start = $cursor;
                $end = $cursor + (float) $scene->duration_seconds;
                $cursor = $end;

                return implode("\n", [
                    (string) ($index + 1),
                    $this->formatTimestamp($start).' --> '.$this->formatTimestamp($end),
                    $scene->text,
                ]);
            })
            ->implode("\n\n")."\n";
    }

    private function formatTimestamp(float $seconds): string
    {
        $milliseconds = (int) round(($seconds - floor($seconds)) * 1000);
        $totalSeconds = (int) floor($seconds);
        $hours = intdiv($totalSeconds, 3600);
        $minutes = intdiv($totalSeconds % 3600, 60);
        $remainingSeconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d,%03d', $hours, $minutes, $remainingSeconds, $milliseconds);
    }
}
