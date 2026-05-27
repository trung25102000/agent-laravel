<?php

namespace App\Services\AI\Contracts;

use App\DTOs\ScriptGenerationResult;
use App\Models\VideoProject;

interface ScriptGeneratorInterface
{
    public function generate(VideoProject $videoProject): ScriptGenerationResult;
}
