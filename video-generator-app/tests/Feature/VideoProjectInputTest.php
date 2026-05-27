<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoProjectInputTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_video_project_form(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/video-projects/create');

        $response->assertOk();
        $response->assertSee('Create video project');
        $response->assertSee('MVP template');
        $response->assertSee('Keyword');
        $response->assertSee('TikTok');
        $response->assertSee('3 minutes');
    }

    public function test_authenticated_user_can_create_video_project(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/video-projects', [
            'keyword' => 'daily marketing tips',
            'content_brief' => 'A concise video for small business owners.',
            'tone' => 'educational',
            'duration_seconds' => 30,
            'platform' => 'tiktok',
            'language' => 'vi',
        ]);

        $videoProject = $user->videoProjects()->firstOrFail();

        $response->assertRedirect(route('video-projects.show', $videoProject));

        $this->assertSame('daily marketing tips', $videoProject->keyword);
        $this->assertSame(VideoProjectStatusEnum::Draft, $videoProject->status);
        $this->assertSame(0, $videoProject->progress_percent);
    }

    public function test_video_project_form_validates_required_and_platform_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/video-projects/create')->post('/video-projects', [
            'keyword' => '',
            'tone' => 'educational',
            'duration_seconds' => 30,
            'platform' => 'instagram',
            'language' => 'vi',
        ]);

        $response->assertRedirect('/video-projects/create');
        $response->assertSessionHasErrors(['keyword', 'platform']);
        $this->followingRedirects()
            ->actingAs($user)
            ->from('/video-projects/create')
            ->post('/video-projects', [
                'keyword' => '',
                'tone' => 'educational',
                'duration_seconds' => 30,
                'platform' => 'instagram',
                'language' => 'vi',
            ])
            ->assertSee('The keyword field is required.')
            ->assertSee('The selected platform is invalid.');
        $this->assertDatabaseCount('video_projects', 0);
    }
}
