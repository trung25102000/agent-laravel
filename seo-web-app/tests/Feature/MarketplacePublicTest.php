<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\FaqItem;
use App\Models\PricingPackage;
use App\Models\SourceCodeProduct;
use App\Models\TemplateCategory;
use App\Models\WebsiteTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketplacePublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_marketplace_pages_are_rendered(): void
    {
        $this->withoutVite();

        $category = TemplateCategory::query()->create(['name' => 'Shop nhỏ', 'slug' => 'shop-nho']);
        WebsiteTemplate::query()->create([
            'template_category_id' => $category->id,
            'name' => 'Mẫu shop mỹ phẩm',
            'slug' => 'mau-shop-my-pham',
            'summary' => 'Mẫu đẹp cho shop nhỏ',
            'price' => 2000000,
            'status' => 'active',
        ]);
        PricingPackage::query()->create([
            'name' => 'Basic Shop',
            'slug' => 'basic-shop',
            'audience_type' => 'shop_owner',
            'package_type' => 'website',
            'price' => 2500000,
            'benefits' => ['Catalog', 'CTA Zalo'],
            'is_active' => true,
        ]);
        SourceCodeProduct::query()->create([
            'name' => 'Source Laravel bán hàng',
            'slug' => 'source-laravel-ban-hang',
            'summary' => 'Có database mẫu',
            'price' => 2500000,
            'status' => 'active',
        ]);
        BlogPost::query()->create([
            'title' => 'SEO cho shop nhỏ',
            'slug' => 'seo-cho-shop-nho',
            'content' => 'Nội dung SEO',
            'status' => 'published',
            'published_at' => now(),
        ]);
        FaqItem::query()->create([
            'audience_type' => 'shop_owner',
            'question' => 'Có demo không?',
            'answer' => 'Có demo rõ ràng.',
        ]);

        $this->get('/')->assertOk()->assertSee('Có website đẹp để khách tin hơn');
        $this->get('/services')->assertOk()->assertSee('Làm website, landing page');
        $this->get('/templates')->assertOk()->assertSee('Mẫu shop mỹ phẩm');
        $this->get('/templates/mau-shop-my-pham')->assertOk()->assertSee('Đặt mua mẫu này');
        $this->get('/pricing/shop')->assertOk()->assertSee('Basic Shop');
        $this->get('/source-code')->assertOk()->assertSee('Source Laravel bán hàng');
        $this->get('/blog')->assertOk()->assertSee('SEO cho shop nhỏ');
        $this->get('/sitemap.xml')->assertOk()->assertSee('/templates/mau-shop-my-pham');
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap:');
    }
}
