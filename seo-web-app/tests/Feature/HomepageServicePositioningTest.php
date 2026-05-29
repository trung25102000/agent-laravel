<?php

namespace Tests\Feature;

use App\Models\ServiceOffering;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageServicePositioningTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_positions_services_as_primary_offer(): void
    {
        $this->withoutVite();

        ServiceOffering::query()->create([
            'name' => 'Nhận làm task lập trình nhanh',
            'slug' => 'nhan-lam-task-lap-trinh-nhanh',
            'service_group' => 'coding_task',
            'short_description' => 'Fix bug, API, UI và database theo scope nhỏ.',
            'detail_description' => 'Chi tiết dịch vụ task code.',
            'status' => 'published',
            'sort_order' => 1,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-hero-section', false);
        $response->assertSee('data-hero-visuals', false);
        $response->assertSee('data-rotating-media-showcase', false);
        $response->assertSee('data-hero-media-rail', false);
        $response->assertSee('data-landing-section="services"', false);
        $response->assertSee('data-service-visual-grid', false);
        $response->assertSee('data-service-visual-card', false);
        $response->assertSee('data-landing-section="portfolio"', false);
        $response->assertSee('data-landing-section="feedback"', false);
        $response->assertSee('data-process-timeline', false);
        $response->assertDontSee('data-tech-marquee', false);
        $response->assertSee('data-conversion-strip', false);
        $response->assertSee('data-conversion-proof-strip', false);
        $response->assertSee('data-footer-emphasis', false);
        $response->assertSee('data-floating-contact', false);
        $response->assertSee('Biến Ý Tưởng Thành Website Chuyên Nghiệp Chỉ Trong Vài Ngày');
        $response->assertSee('Nhận làm task lập trình nhanh');
        $response->assertSee('Xem Dự Án Đã Thực Hiện');
        $response->assertSee('Technical Consultation');
        $response->assertSee('Support board cho handoff');
        $response->assertSee('Nhận scope và báo giá nhanh');
        $response->assertDontSee('Công nghệ sử dụng');
    }
}
