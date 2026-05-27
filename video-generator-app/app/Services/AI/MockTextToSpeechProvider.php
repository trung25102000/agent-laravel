<?php

namespace App\Services\AI;

use App\DTOs\GeneratedAudio;
use App\Models\VideoProject;
use App\Services\AI\Contracts\TextToSpeechInterface;
use Illuminate\Support\Facades\Storage;

class MockTextToSpeechProvider implements TextToSpeechInterface
{
    public function generate(VideoProject $videoProject, string $narration): GeneratedAudio
    {
        $disk = config('video_pipeline.storage.disk');
        $path = "audio/video-projects/{$videoProject->id}/voice-over.txt";

        Storage::disk($disk)->put($path, $narration);

        return new GeneratedAudio(
            disk: $disk,
            path: $path,
            durationSeconds: max(1.0, round(str_word_count($narration) / 2.5, 2)),
            mimeType: 'text/plain',
        );
    }
}
