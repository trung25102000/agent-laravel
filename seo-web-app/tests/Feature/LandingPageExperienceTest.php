<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_reads_like_a_customer_product_landing_page(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-landing-section="hero"', false);
        $response->assertSee('data-landing-section="problems"', false);
        $response->assertSee('data-landing-section="solutions"', false);
        $response->assertSee('data-landing-section="trust"', false);
        $response->assertSee('data-contact-cta', false);
    }

    public function test_homepage_explains_customer_problems_and_service_value(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Không biết làm website ở đâu');
        $response->assertSee('Website tải chậm');
        $response->assertSee('Website không có khách');
        $response->assertSee('Landing Page không chuyển đổi');
        $response->assertSee('Đồ án sắp tới hạn');
        $response->assertSee('Không đủ người xử lý task');
        $response->assertSee('Mỗi pain point đều có hướng xử lý rõ');
        $response->assertSee('Có demo trước khi bàn giao');
        $response->assertSee('Giao diện đẹp, tối ưu mobile');
        $response->assertSee('Form thu lead và CTA rõ ràng');
        $response->assertSee('Bàn giao source, database, tài liệu');
    }

    public function test_homepage_has_reveal_animation_markers_without_admin_dashboard_copy(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-reveal', false);
        $response->assertSee('--reveal-delay', false);
        $response->assertDontSee('Admin Dashboard');
        $response->assertDontSee('trang quản trị');
        $response->assertDontSee('Laravel News');
        $response->assertDontSee('Laracasts');
        $response->assertDontSee('Documentation');
    }
}
