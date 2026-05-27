<?php

namespace App\Services;

use App\Enums\VideoProjectStatusEnum;
use App\Models\VideoProject;
use App\Services\AI\Contracts\ScriptGeneratorInterface;

class ScriptGenerationService
{
    public function __construct(
        private readonly ScriptGeneratorInterface $scriptGenerator,
    ) {
    }

    public function generate(VideoProject $videoProject): VideoProject
    {
        $videoProject->forceFill([
            'status' => VideoProjectStatusEnum::Scripting,
            'progress_percent' => max($videoProject->progress_percent, 10),
            'error_message' => null,
        ])->save();

        $result = $this->scriptGenerator->generate($videoProject->refresh());

        $videoProject->forceFill([
            'script_content' => $result->toScriptText(),
            'progress_percent' => max($videoProject->progress_percent, 20),
        ])->save();

        return $videoProject->refresh();
    }
}
