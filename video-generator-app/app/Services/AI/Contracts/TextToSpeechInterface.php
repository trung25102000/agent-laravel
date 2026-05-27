<?php

namespace App\Services\AI\Contracts;

use App\DTOs\GeneratedAudio;
use App\Models\VideoProject;

interface TextToSpeechInterface
{
    public function generate(VideoProject $videoProject, string $narration): GeneratedAudio;
}
