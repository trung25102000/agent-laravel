<?php

namespace Tests\Feature;

use App\Models\PricingPackage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PricingReferenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_pricing_pages_render_service_platform_reference_packages(): void
    {
        $this->withoutVite();

        PricingPackage::query()->create([
            'name' => 'SEO On-Page Boost',
            'slug' => 'seo-on-page-boost',
            'audience_type' => 'shop_owner',
            'package_type' => 'seo',
            'price' => 1500000,
            'summary' => 'Gói SEO tham khảo',
            'benefits' => ['Audit nhanh', 'Tối ưu meta'],
            'is_active' => true,
        ]);

        PricingPackage::query()->create([
            'name' => 'Coding Task Quick Win',
            'slug' => 'coding-task-quick-win',
            'audience_type' => 'online_seller',
            'package_type' => 'coding_task',
            'price' => 900000,
            'summary' => 'Task code nhanh',
            'benefits' => ['Fix bug', 'Bàn giao ngắn'],
            'is_active' => true,
        ]);

        $this->get('/pricing/seo')
            ->assertOk()
            ->assertSee('SEO On-Page Boost')
            ->assertSee('Nhận báo giá chính xác');

        $this->get('/pricing/coding-task')
            ->assertOk()
            ->assertSee('Coding Task Quick Win')
            ->assertSee('Xem dịch vụ liên quan');
    }
}
