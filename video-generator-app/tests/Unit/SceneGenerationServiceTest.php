<?php

namespace Tests\Unit;

use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use App\Services\SceneGenerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SceneGenerationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_ordered_scenes_from_script_content(): void
    {
        $videoProject = VideoProject::factory()->create([
            'keyword' => 'productivity habits',
            'tone' => 'inspiring',
            'duration_seconds' => 30,
            'script_content' => "Scene 1: Start with a bold hook.\nScene 2: Show one practical habit.\nScene 3: End with a simple challenge.",
        ]);

        $scenes = app(SceneGenerationService::class)->generate($videoProject);

        $this->assertCount(3, $scenes);
        $this->assertSame([1, 2, 3], $scenes->pluck('sort_order')->all());
        $this->assertSame('Start with a bold hook.', $scenes->first()->text);
        $this->assertSame(VideoSceneStatusEnum::Ready, $scenes->first()->status);
        $this->assertStringContainsString('productivity habits', $scenes->first()->visual_prompt);
        $this->assertEqualsWithDelta(30, (float) $scenes->sum('duration_seconds'), 0.1);
    }

    public function test_video_project_has_ordered_scene_relationship(): void
    {
        $videoProject = VideoProject::factory()->create();

        $videoProject->scenes()->createMany([
            [
                'sort_order' => 2,
                'text' => 'Second scene',
                'duration_seconds' => 5,
                'visual_prompt' => 'Second visual',
                'status' => VideoSceneStatusEnum::Ready,
            ],
            [
                'sort_order' => 1,
                'text' => 'First scene',
                'duration_seconds' => 5,
                'visual_prompt' => 'First visual',
                'status' => VideoSceneStatusEnum::Ready,
            ],
        ]);

        $this->assertSame(['First scene', 'Second scene'], $videoProject->refresh()->scenes->pluck('text')->all());
    }
}
