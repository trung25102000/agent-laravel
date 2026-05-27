<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandedEntryUiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_branded_landing_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Website trẻ trung, dễ dùng, triển khai nhanh');
        $response->assertSee('Mua template web, landing page và source Laravel');
        $response->assertSee('Xem mẫu web');
        $response->assertSee('Nhận tư vấn');
        $response->assertDontSee('Documentation');
        $response->assertDontSee('Laracasts');
        $response->assertDontSee('Laravel News');
    }

    public function test_authenticated_user_gets_workspace_cta_on_landing_page(): void
    {
        $this->withoutVite();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertOk();
        $response->assertSee('Workspace');
        $response->assertDontSee('Nhận tư vấn');
    }

    public function test_guest_can_view_branded_login_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Log in to your AI video workspace');
        $response->assertSee('Email');
        $response->assertSee('Password');
        $response->assertSee('Remember this device');
        $response->assertSee('Create an account');
        $response->assertDontSee('Sign in');
    }

    public function test_login_validation_errors_render_in_branded_form(): void
    {
        $this->withoutVite();

        $response = $this->followingRedirects()->from('/login')->post('/login', [
            'email' => 'missing@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertOk();
        $response->assertSee('Log in to your AI video workspace');
        $response->assertSee('These credentials do not match our records.');
    }

    public function test_guest_can_view_branded_register_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/register');

        $response->assertOk();
        $response->assertSee('Create your AI video workspace');
        $response->assertSee('New creator account');
        $response->assertSee('Create video workspace');
        $response->assertSee('Already have an account?');
    }
}
