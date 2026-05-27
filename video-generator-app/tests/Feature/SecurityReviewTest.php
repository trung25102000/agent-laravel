<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_status_does_not_expose_rendered_storage_path(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'rendered_video_path' => 'videos/private-output.txt',
        ]);

        $response = $this->actingAs($user)->getJson("/api/video-projects/{$videoProject->id}/status");

        $response->assertOk();
        $response->assertJsonPath('output_ready', true);
        $response->assertJsonMissingPath('rendered_video_path');
    }

    public function test_api_result_does_not_expose_rendered_storage_path(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'status' => VideoProjectStatusEnum::Completed,
            'rendered_video_path' => 'videos/private-output.txt',
        ]);

        $response = $this->actingAs($user)->getJson("/api/video-projects/{$videoProject->id}/result");

        $response->assertOk();
        $response->assertJsonPath('data.output_ready', true);
        $response->assertJsonMissingPath('data.rendered_video_path');
        $response->assertJsonStructure([
            'data' => ['preview_url', 'download_url'],
        ]);
    }
}
