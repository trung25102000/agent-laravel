<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use App\Models\VideoScene;
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

    public function test_owner_can_view_project_progress_page_with_pipeline_steps(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'progress page',
            'status' => VideoProjectStatusEnum::Rendering,
            'progress_percent' => 90,
            'script_content' => 'Generated script preview',
        ]);
        VideoScene::factory()->create([
            'video_project_id' => $videoProject->id,
            'sort_order' => 1,
            'text' => 'Opening scene narration',
        ]);

        $response = $this->actingAs($user)->get(route('video-projects.show', $videoProject));

        $response->assertOk();
        $response->assertSee('Generation progress');
        $response->assertSee('Script');
        $response->assertSee('Scenes');
        $response->assertSee('Media');
        $response->assertSee('Voice');
        $response->assertSee('Subtitle');
        $response->assertSee('Render');
        $response->assertSee('Generated script preview');
        $response->assertSee('Opening scene narration');
    }
}
