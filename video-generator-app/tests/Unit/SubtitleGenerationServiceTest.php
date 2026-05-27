<?php

namespace Tests\Unit;

use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use App\Services\SubtitleGenerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SubtitleGenerationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_srt_from_scene_timings_and_persists_path(): void
    {
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create([
            'progress_percent' => 60,
        ]);

        $videoProject->scenes()->createMany([
            [
                'sort_order' => 1,
                'text' => 'First subtitle line',
                'duration_seconds' => 2.5,
                'visual_prompt' => 'First visual',
                'status' => VideoSceneStatusEnum::Ready,
            ],
            [
                'sort_order' => 2,
                'text' => 'Second subtitle line',
                'duration_seconds' => 3,
                'visual_prompt' => 'Second visual',
                'status' => VideoSceneStatusEnum::Ready,
            ],
        ]);

        $updatedProject = app(SubtitleGenerationService::class)->generate($videoProject->refresh());

        $this->assertSame('local', $updatedProject->subtitle_disk);
        $this->assertSame("subtitles/video-projects/{$videoProject->id}/subtitles.srt", $updatedProject->subtitle_path);
        $this->assertSame(70, $updatedProject->progress_percent);
        Storage::disk('local')->assertExists($updatedProject->subtitle_path);

        $content = Storage::disk('local')->get($updatedProject->subtitle_path);
        $this->assertStringContainsString('00:00:00,000 --> 00:00:02,500', $content);
        $this->assertStringContainsString('00:00:02,500 --> 00:00:05,500', $content);
        $this->assertStringContainsString('First subtitle line', $content);
        $this->assertStringContainsString('Second subtitle line', $content);
    }
}
