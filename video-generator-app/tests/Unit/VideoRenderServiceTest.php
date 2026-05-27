<?php

namespace Tests\Unit;

use App\Enums\VideoAssetTypeEnum;
use App\Enums\VideoProjectStatusEnum;
use App\Jobs\RenderVideoJob;
use App\Models\VideoProject;
use App\Services\VideoRenderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VideoRenderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_mock_output_and_updates_project(): void
    {
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create([
            'script_content' => 'Generated script',
            'audio_path' => 'audio/mock.txt',
            'subtitle_path' => 'subtitles/mock.srt',
            'progress_percent' => 70,
        ]);

        $updatedProject = app(VideoRenderService::class)->render($videoProject);

        $this->assertSame(VideoProjectStatusEnum::Completed, $updatedProject->status);
        $this->assertSame(100, $updatedProject->progress_percent);
        $this->assertSame("videos/video-projects/{$videoProject->id}/output.txt", $updatedProject->rendered_video_path);
        $this->assertSame('local', $updatedProject->output_disk);

        Storage::disk('local')->assertExists($updatedProject->rendered_video_path);

        $this->assertDatabaseHas('video_assets', [
            'video_project_id' => $videoProject->id,
            'type' => VideoAssetTypeEnum::Output->value,
            'path' => $updatedProject->rendered_video_path,
        ]);
    }

    public function test_render_video_job_handles_project(): void
    {
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create([
            'progress_percent' => 70,
        ]);

        app(RenderVideoJob::class, ['videoProjectId' => $videoProject->id])
            ->handle(app(VideoRenderService::class));

        $this->assertSame(VideoProjectStatusEnum::Completed, $videoProject->refresh()->status);
        $this->assertNotNull($videoProject->rendered_video_path);
    }
}
