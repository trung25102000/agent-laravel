<?php

namespace Tests\Feature;

use App\Models\User;
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
}
