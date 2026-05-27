<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoProjectModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_project_can_be_created_for_user(): void
    {
        $user = User::factory()->create();

        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'healthy breakfast ideas',
            'status' => VideoProjectStatusEnum::Draft,
        ]);

        $this->assertTrue($videoProject->user->is($user));
        $this->assertTrue($user->videoProjects()->whereKey($videoProject)->exists());
        $this->assertSame(VideoProjectStatusEnum::Draft, $videoProject->status);
        $this->assertSame(0, $videoProject->progress_percent);
    }

    public function test_dashboard_only_lists_current_users_video_projects(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'owner project',
        ]);

        VideoProject::factory()->create([
            'user_id' => $otherUser->id,
            'keyword' => 'other project',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('owner project');
        $response->assertDontSee('other project');
    }
}
