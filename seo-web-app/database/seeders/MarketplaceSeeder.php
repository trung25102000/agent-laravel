<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\FaqItem;
use App\Models\PricingPackage;
use App\Models\SourceCodeProduct;
use App\Models\TemplateCategory;
use App\Models\WebsiteTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect(['Shop thời trang', 'Mỹ phẩm', 'Quán ăn', 'Landing page', 'Đồ án Laravel'])
            ->mapWithKeys(fn ($name) => [$name => TemplateCategory::query()->firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => "Mẫu web cho {$name}", 'is_active' => true]
            )]);

        foreach ([
            ['Web shop thời trang mini', 'shop_owner', 'website', 'Shop thời trang', 2500000],
            ['Landing page mỹ phẩm chốt lead', 'online_seller', 'landing_page', 'Landing page', 1800000],
            ['Catalog quán ăn đặt món Zalo', 'shop_owner', 'catalog', 'Quán ăn', 2200000],
        ] as [$name, $audience, $type, $category, $price]) {
            WebsiteTemplate::query()->firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'template_category_id' => $categories[$category]->id,
                    'name' => $name,
                    'audience_type' => $audience,
                    'template_type' => $type,
                    'summary' => 'Giao diện trẻ trung, dễ chỉnh sửa, tối ưu mobile và CTA rõ.',
                    'description' => 'Mẫu phù hợp triển khai nhanh cho shop nhỏ và cá nhân kinh doanh online.',
                    'price' => $price,
                    'demo_url' => 'https://example.com/demo',
                    'status' => 'active',
                ]
            );
        }

        foreach ([
            ['Basic Shop', 'shop_owner', 'website', 2500000, ['Trang giới thiệu', 'Catalog sản phẩm', 'Nút Zalo/Facebook']],
            ['Landing Ads', 'online_seller', 'landing_page', 1800000, ['Hero chốt offer', 'Form thu lead', 'Tối ưu mobile']],
            ['Laravel Graduation', 'student', 'graduation_project', 3500000, ['Source Laravel', 'Database mẫu', 'Báo cáo và hướng dẫn']],
        ] as [$name, $audience, $type, $price, $benefits]) {
            PricingPackage::query()->firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'audience_type' => $audience,
                    'package_type' => $type,
                    'price' => $price,
                    'summary' => 'Gói triển khai rõ phạm vi, dễ nghiệm thu.',
                    'benefits' => $benefits,
                    'is_featured' => $type !== 'website',
                    'is_active' => true,
                ]
            );
        }

        SourceCodeProduct::query()->firstOrCreate(
            ['slug' => 'source-laravel-ban-hang-do-an'],
            [
                'name' => 'Source Laravel bán hàng cho đồ án',
                'framework' => 'Laravel',
                'summary' => 'Có auth, admin, sản phẩm, đơn hàng, database mẫu và hướng dẫn cài đặt.',
                'description' => 'Bộ source phù hợp sinh viên cần demo đồ án tốt nghiệp hoặc môn học Laravel.',
                'price' => 2500000,
                'demo_url' => 'https://example.com/source-demo',
                'status' => 'active',
            ]
        );

        foreach ([
            ['shop_owner', 'Website shop nhỏ có cần thanh toán online không?', 'MVP có thể chốt qua Zalo trước, thanh toán online có thể thêm ở phase sau.'],
            ['online_seller', 'Landing page có dùng để chạy quảng cáo ngay không?', 'Có, form lead và CTA được đặt rõ để dùng cho chiến dịch quảng cáo.'],
            ['student', 'Source đồ án có kèm database và báo cáo không?', 'Có thể chọn kèm database mẫu, báo cáo hướng dẫn và tài liệu chạy project.'],
        ] as [$audience, $question, $answer]) {
            FaqItem::query()->firstOrCreate(
                ['question' => $question],
                ['audience_type' => $audience, 'answer' => $answer, 'is_active' => true]
            );
        }

        BlogPost::query()->firstOrCreate(
            ['slug' => 'chon-website-cho-shop-nho'],
            [
                'title' => 'Cách chọn website cho shop nhỏ',
                'audience_type' => 'shop_owner',
                'excerpt' => 'Các phần cần có để shop nhỏ bán hàng rõ ràng hơn.',
                'content' => 'Một website shop nhỏ nên có catalog, thông tin liên hệ, CTA Zalo và nội dung dễ cập nhật.',
                'status' => 'published',
                'published_at' => now(),
            ]
        );
    }
}
