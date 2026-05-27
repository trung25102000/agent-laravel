<?php

namespace Tests\Unit;

use App\Enums\VideoProjectStatusEnum;
use App\Models\VideoProject;
use App\Services\ScriptGenerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScriptGenerationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_and_persists_mock_script_for_video_project(): void
    {
        $videoProject = VideoProject::factory()->create([
            'keyword' => 'AI cooking tips',
            'tone' => 'educational',
            'duration_seconds' => 30,
            'platform' => 'tiktok',
            'language' => 'en',
        ]);

        $updatedProject = app(ScriptGenerationService::class)->generate($videoProject);

        $this->assertSame(VideoProjectStatusEnum::Scripting, $updatedProject->status);
        $this->assertSame(20, $updatedProject->progress_percent);
        $this->assertNotNull($updatedProject->script_content);
        $this->assertStringContainsString('AI cooking tips', $updatedProject->script_content);
        $this->assertDatabaseHas('video_projects', [
            'id' => $videoProject->id,
            'status' => VideoProjectStatusEnum::Scripting->value,
            'progress_percent' => 20,
        ]);
    }
}
