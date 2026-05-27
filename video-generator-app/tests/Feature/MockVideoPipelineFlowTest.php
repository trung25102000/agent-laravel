<?php

namespace Tests\Feature;

use App\Enums\VideoAssetTypeEnum;
use App\Enums\VideoProjectStatusEnum;
use App\Models\VideoProject;
use App\Services\MediaAssetSelectionService;
use App\Services\SceneGenerationService;
use App\Services\ScriptGenerationService;
use App\Services\SubtitleGenerationService;
use App\Services\VideoRenderService;
use App\Services\VoiceOverGenerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MockVideoPipelineFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_mock_pipeline_generates_project_artifacts_end_to_end(): void
    {
        Notification::fake();
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create([
            'keyword' => 'healthy lunch ideas',
            'content_brief' => 'A short practical video.',
            'duration_seconds' => 30,
        ]);

        $videoProject = app(ScriptGenerationService::class)->generate($videoProject);
        $scenes = app(SceneGenerationService::class)->generate($videoProject);
        $assets = app(MediaAssetSelectionService::class)->selectForProject($videoProject->refresh());
        $videoProject = app(VoiceOverGenerationService::class)->generate($videoProject->refresh());
        $videoProject = app(SubtitleGenerationService::class)->generate($videoProject);
        $videoProject = app(VideoRenderService::class)->render($videoProject);

        $this->assertSame(VideoProjectStatusEnum::Completed, $videoProject->status);
        $this->assertSame(100, $videoProject->progress_percent);
        $this->assertNotNull($videoProject->script_content);
        $this->assertGreaterThanOrEqual(3, $scenes->count());
        $this->assertCount($scenes->count(), $assets);
        $this->assertNotNull($videoProject->audio_path);
        $this->assertNotNull($videoProject->subtitle_path);
        $this->assertNotNull($videoProject->rendered_video_path);

        Storage::disk('local')->assertExists($videoProject->audio_path);
        Storage::disk('local')->assertExists($videoProject->subtitle_path);
        Storage::disk('local')->assertExists($videoProject->rendered_video_path);

        $this->assertDatabaseHas('video_assets', [
            'video_project_id' => $videoProject->id,
            'type' => VideoAssetTypeEnum::Output->value,
        ]);
    }
}
