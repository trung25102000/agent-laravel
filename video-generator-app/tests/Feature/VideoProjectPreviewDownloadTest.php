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
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'preview project',
            'rendered_video_path' => 'videos/video-projects/1/output.txt',
        ]);

        $response = $this->actingAs($user)->get(route('video-projects.preview', $videoProject));

        $response->assertOk();
        $response->assertSee('Preview: preview project');
        $response->assertSee('Download video');
    }

    public function test_non_owner_cannot_preview_project(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create();

        $this->actingAs($user)
            ->get(route('video-projects.preview', $videoProject))
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
