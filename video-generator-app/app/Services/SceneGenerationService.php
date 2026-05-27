<?php

namespace App\Services;

use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SceneGenerationService
{
    /**
     * @return Collection<int, \App\Models\VideoScene>
     */
    public function generate(VideoProject $videoProject): Collection
    {
        $lines = $this->extractSceneLines($videoProject);
        $duration = round($videoProject->duration_seconds / max(count($lines), 1), 2);

        return DB::transaction(function () use ($videoProject, $lines, $duration): Collection {
            $videoProject->scenes()->delete();

            foreach ($lines as $index => $line) {
                $videoProject->scenes()->create([
                    'sort_order' => $index + 1,
                    'text' => $line,
                    'duration_seconds' => $duration,
                    'visual_prompt' => $this->visualPromptFor($videoProject, $line),
                    'status' => VideoSceneStatusEnum::Ready,
                ]);
            }

            return $videoProject->refresh()->scenes;
        });
    }

    /**
     * @return array<int, string>
     */
    private function extractSceneLines(VideoProject $videoProject): array
    {
        $script = $videoProject->script_content ?: $videoProject->content_brief ?: $videoProject->keyword;

        $lines = collect(preg_split('/\R+/', $script) ?: [])
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->map(fn (string $line): string => preg_replace('/^Scene\s+\d+\s*:\s*/i', '', $line) ?: $line)
            ->values();

        if ($lines->isEmpty()) {
            return ["Introduce {$videoProject->keyword}."];
        }

        return $lines->take(8)->all();
    }

    private function visualPromptFor(VideoProject $videoProject, string $line): string
    {
        return Str::of($line)
            ->prepend("Vertical 9:16 {$videoProject->tone} scene about {$videoProject->keyword}: ")
            ->append(' cinematic, clear subject, social video background')
            ->toString();
    }
}
