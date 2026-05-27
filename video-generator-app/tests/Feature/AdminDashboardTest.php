<?php

namespace Tests\Feature;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_dashboard(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create(['email' => 'creator@example.com']);
        VideoProject::factory()->create([
            'user_id' => $user->id,
            'keyword' => 'admin visible project',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertOk();
        $response->assertSee('Admin dashboard');
        $response->assertSee('creator@example.com');
        $response->assertSee('admin visible project');
    }

    public function test_non_admin_cannot_view_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_admin_can_filter_projects_by_status(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['is_admin' => true]);
        VideoProject::factory()->create([
            'keyword' => 'completed project',
            'status' => VideoProjectStatusEnum::Completed,
        ]);
        VideoProject::factory()->create([
            'keyword' => 'failed project',
            'status' => VideoProjectStatusEnum::Failed,
        ]);

        $response = $this->actingAs($admin)->get('/admin?status=completed');

        $response->assertOk();
        $response->assertSee('completed project');
        $response->assertDontSee('failed project');
    }
}
