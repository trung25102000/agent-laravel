<?php

namespace Tests\Unit;

use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use App\Services\VoiceOverGenerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VoiceOverGenerationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_mock_voice_over_and_persists_audio_path(): void
    {
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create([
            'script_content' => 'Fallback script',
            'progress_percent' => 20,
        ]);

        $videoProject->scenes()->create([
            'sort_order' => 1,
            'text' => 'First narration line',
            'duration_seconds' => 5,
            'visual_prompt' => 'First visual',
            'status' => VideoSceneStatusEnum::Ready,
        ]);

        $updatedProject = app(VoiceOverGenerationService::class)->generate($videoProject);

        $this->assertSame('local', $updatedProject->audio_disk);
        $this->assertSame("audio/video-projects/{$videoProject->id}/voice-over.txt", $updatedProject->audio_path);
        $this->assertSame(60, $updatedProject->progress_percent);
        $this->assertNotNull($updatedProject->audio_duration_seconds);

        Storage::disk('local')->assertExists($updatedProject->audio_path);
        $this->assertStringContainsString(
            'First narration line',
            Storage::disk('local')->get($updatedProject->audio_path)
        );
    }
}
