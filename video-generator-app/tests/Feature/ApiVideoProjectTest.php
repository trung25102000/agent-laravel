<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiVideoProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_video_project_via_api(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/video-projects', [
            'keyword' => 'api project',
            'content_brief' => 'Create this from API.',
            'tone' => 'neutral',
            'duration_seconds' => 30,
            'platform' => 'tiktok',
            'language' => 'vi',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.keyword', 'api project');
        $this->assertDatabaseHas('video_projects', [
            'user_id' => $user->id,
            'keyword' => 'api project',
        ]);
    }

    public function test_api_status_returns_project_progress(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'status' => VideoProjectStatusEnum::Rendering,
            'progress_percent' => 90,
        ]);

        $response = $this->actingAs($user)->getJson("/api/video-projects/{$videoProject->id}/status");

        $response->assertOk();
        $response->assertJsonPath('status', 'rendering');
        $response->assertJsonPath('progress_percent', 90);
    }

    public function test_api_result_returns_completed_project(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'status' => VideoProjectStatusEnum::Completed,
            'rendered_video_path' => 'videos/output.txt',
        ]);

        $response = $this->actingAs($user)->getJson("/api/video-projects/{$videoProject->id}/result");

        $response->assertOk();
        $response->assertJsonPath('data.status', 'completed');
        $response->assertJsonPath('data.output_ready', true);
        $response->assertJsonMissingPath('data.rendered_video_path');
        $response->assertJsonStructure([
            'data' => ['preview_url', 'download_url'],
        ]);
    }

    public function test_api_blocks_unauthenticated_and_forbidden_requests(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $videoProject = VideoProject::factory()->create(['user_id' => $owner->id]);

        $this->postJson('/api/video-projects', [])->assertUnauthorized();

        $this->actingAs($otherUser)
            ->getJson("/api/video-projects/{$videoProject->id}/status")
            ->assertForbidden();
    }
}
