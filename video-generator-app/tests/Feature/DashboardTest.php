<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_dashboard_empty_state(): void
    {
        $this->withoutVite();

        $user = User::factory()->create([
            'name' => 'Creator One',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Welcome, Creator One.');
        $response->assertSee('Your video projects');
        $response->assertSee('You have not created any video projects yet.');
        $response->assertSee('Create a new video');
    }

    public function test_dashboard_lists_recent_projects_with_status_and_metadata(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();
        VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'launch tips',
            'platform' => 'tiktok',
            'language' => 'vi',
            'duration_seconds' => 60,
            'status' => VideoProjectStatusEnum::Rendering,
            'progress_percent' => 90,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('launch tips');
        $response->assertSee('Rendering');
        $response->assertSee('TikTok');
        $response->assertSee('Vietnamese');
        $response->assertSee('1m');
        $response->assertSee('90%');
    }
}
