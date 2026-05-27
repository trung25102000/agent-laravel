<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VideoProjectPreviewDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_preview_page(): void
    {
        Storage::fake('local');
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'preview project',
            'rendered_video_path' => 'videos/video-projects/1/output.mp4',
            'output_disk' => 'local',
            'audio_path' => 'videos/video-projects/1/generated-voice.wav',
            'audio_disk' => 'local',
            'render_duration_seconds' => 180,
            'render_size_bytes' => 1024 * 1024,
            'render_metadata' => [
                'mime_type' => 'video/mp4',
                'width' => 1080,
                'height' => 1920,
            ],
        ]);
        Storage::disk('local')->put($videoProject->rendered_video_path, 'fake mp4 bytes');

        $response = $this->actingAs($user)->get(route('video-projects.preview', $videoProject));

        $response->assertOk();
        $response->assertSee('Preview: preview project');
        $response->assertSee('<video', false);
        $response->assertSee(route('video-projects.stream', $videoProject), false);
        $response->assertSee('Download video');
        $response->assertSee('Audio');
        $response->assertSee('Ready');
        $response->assertSee('3m 00s');
        $response->assertSee('1080x1920');
        $response->assertSee('1 MB');
    }

    public function test_owner_can_view_preview_empty_state_before_render(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'waiting project',
            'rendered_video_path' => null,
        ]);

        $response = $this->actingAs($user)->get(route('video-projects.preview', $videoProject));

        $response->assertOk();
        $response->assertSee('Preview: waiting project');
        $response->assertSee('This video has not been rendered yet.');
        $response->assertSee('Download unlocks when the output file exists.');
    }

    public function test_preview_shows_missing_output_state_without_absolute_path(): void
    {
        Storage::fake('local');
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'missing output project',
            'rendered_video_path' => 'videos/video-projects/99/output.mp4',
            'output_disk' => 'local',
            'render_metadata' => ['mime_type' => 'video/mp4'],
        ]);

        $response = $this->actingAs($user)->get(route('video-projects.preview', $videoProject));

        $response->assertOk();
        $response->assertSee('Output file is missing');
        $response->assertDontSee(storage_path(), false);
    }

    public function test_preview_shows_unplayable_state_for_mock_text_output(): void
    {
        Storage::fake('local');
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'mock output project',
            'rendered_video_path' => 'videos/video-projects/1/output.txt',
            'output_disk' => 'local',
        ]);
        Storage::disk('local')->put($videoProject->rendered_video_path, 'mock rendered output');

        $response = $this->actingAs($user)->get(route('video-projects.preview', $videoProject));

        $response->assertOk();
        $response->assertSee('Output is not playable');
        $response->assertDontSee('<video', false);
    }

    public function test_non_owner_cannot_preview_project(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create();

        $this->actingAs($user)
            ->get(route('video-projects.preview', $videoProject))
            ->assertForbidden();
    }

    public function test_owner_can_stream_rendered_mp4_output_inline(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'rendered_video_path' => 'videos/video-projects/1/output.mp4',
            'output_disk' => 'local',
            'render_metadata' => ['mime_type' => 'video/mp4'],
        ]);
        Storage::disk('local')->put($videoProject->rendered_video_path, 'fake mp4 bytes');

        $response = $this->actingAs($user)->get(route('video-projects.stream', $videoProject));

        $response->assertOk();
        $response->assertHeader('content-type', 'video/mp4');
        $response->assertHeader('accept-ranges', 'bytes');
        $this->assertStringContainsString('inline', $response->headers->get('content-disposition'));
    }

    public function test_non_owner_cannot_stream_project_video(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'rendered_video_path' => 'videos/video-projects/1/output.mp4',
            'render_metadata' => ['mime_type' => 'video/mp4'],
        ]);

        $this->actingAs($user)
            ->get(route('video-projects.stream', $videoProject))
            ->assertForbidden();
    }

    public function test_owner_can_download_rendered_output(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'rendered_video_path' => 'videos/video-projects/1/output.txt',
        ]);

        Storage::disk('local')->put($videoProject->rendered_video_path, 'mock rendered video');

        $response = $this->actingAs($user)->get(route('video-projects.download', $videoProject));

        $response->assertOk();
        $response->assertDownload("video-project-{$videoProject->id}.mp4");
    }
}
