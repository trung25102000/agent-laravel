<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use App\Services\VideoProjectStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoProjectStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_service_updates_project_progress_and_error(): void
    {
        $videoProject = VideoProject::factory()->create();

        $updatedProject = app(VideoProjectStatusService::class)->update(
            $videoProject,
            VideoProjectStatusEnum::Failed,
            150,
            'Provider timeout',
        );

        $this->assertSame(VideoProjectStatusEnum::Failed, $updatedProject->status);
        $this->assertSame(100, $updatedProject->progress_percent);
        $this->assertSame('Provider timeout', $updatedProject->error_message);
    }

    public function test_owner_can_view_project_status_payload(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'status' => VideoProjectStatusEnum::Rendering,
            'progress_percent' => 90,
        ]);

        $response = $this->actingAs($user)->getJson(route('video-projects.status', $videoProject));

        $response->assertOk();
        $response->assertJson([
            'id' => $videoProject->id,
            'status' => 'rendering',
            'progress_percent' => 90,
        ]);
    }

    public function test_non_owner_cannot_view_project_status(): void
    {
        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create();

        $this->actingAs($user)
            ->getJson(route('video-projects.status', $videoProject))
            ->assertForbidden();
    }
}
