<?php

namespace App\Services;

use App\Models\VideoProject;
use App\Services\AI\Contracts\TextToSpeechInterface;

class VoiceOverGenerationService
{
    public function __construct(
        private readonly TextToSpeechInterface $textToSpeech,
    ) {}

    public function generate(VideoProject $videoProject): VideoProject
    {
        $narration = $this->narrationFor($videoProject);
        $audio = $this->textToSpeech->generate($videoProject, $narration);

        $videoProject->forceFill([
            'audio_disk' => $audio->disk,
            'audio_path' => $audio->path,
            'audio_duration_seconds' => $audio->durationSeconds,
            'progress_percent' => max($videoProject->progress_percent, 60),
        ])->save();

        return $videoProject->refresh();
    }

    private function narrationFor(VideoProject $videoProject): string
    {
        $sceneNarration = $videoProject->scenes()
            ->pluck('text')
            ->filter()
            ->implode("\n");

        return $sceneNarration ?: (string) $videoProject->script_content;
    }
}
