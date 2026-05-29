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
        $response->assertSee('Biến Ý Tưởng Thành Website Chuyên Nghiệp Chỉ Trong Vài Ngày');
        $response->assertSee('Thiết kế Website');
        $response->assertSee('Phát Triển App Theo Yêu Cầu');
        $response->assertSee('Khách hàng đang gặp vấn đề gì');
        $response->assertSee('Danh sách dịch vụ');
        $response->assertSee('Giải pháp tương ứng');
        $response->assertSee('Nhận Tư Vấn Miễn Phí');
        $response->assertSee('Xem Dự Án Đã Thực Hiện');
        $response->assertSee('Chủ shop nhỏ/lẻ');
        $response->assertSee('Feedback và cam kết');
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
        $response->assertSee('Trang chủ');
    }

    public function test_guest_can_view_branded_login_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Đăng nhập để quản lý khách hàng');
        $response->assertSee('Email');
        $response->assertSee('Mật khẩu');
        $response->assertSee('Ghi nhớ thiết bị này');
        $response->assertSee('Đăng nhập quản trị');
        $response->assertDontSee('AI video workspace');
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
        $response->assertSee('Đăng nhập để quản lý khách hàng');
        $response->assertSee('These credentials do not match our records.');
    }

    public function test_guest_can_view_branded_register_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/register');

        $response->assertOk();
        $response->assertSee('Tạo tài khoản để quản lý yêu cầu dịch vụ');
        $response->assertSee('Web Template Studio');
        $response->assertSee('Tạo tài khoản');
        $response->assertSee('Đã có tài khoản?');
    }
}
