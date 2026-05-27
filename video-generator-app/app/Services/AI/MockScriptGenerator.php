<?php

namespace App\Services\AI;

use App\DTOs\ScriptGenerationResult;
use App\Models\VideoProject;
use App\Services\AI\Contracts\ScriptGeneratorInterface;

class MockScriptGenerator implements ScriptGeneratorInterface
{
    public function generate(VideoProject $videoProject): ScriptGenerationResult
    {
        $keyword = $videoProject->keyword;
        $duration = $videoProject->duration_seconds;
        $platform = str_replace('_', ' ', $videoProject->platform);

        return new ScriptGenerationResult(
            title: "Quick guide: {$keyword}",
            hook: "What if {$keyword} could become a {$duration}-second video people remember?",
            body: "Scene 1: Open with a clear visual about {$keyword}.\n"
                ."Scene 2: Explain the main idea in a {$videoProject->tone} tone for {$platform}.\n"
                ."Scene 3: End with one practical takeaway in {$videoProject->language}.",
            callToAction: 'Save this idea and create your next short-form video today.',
        );
    }
}
