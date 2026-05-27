# Task: Pricing Package Module

## Status
completed

## Priority
high

## Objective
Xây dựng module gói giá để bán template/dịch vụ theo các nhóm: shop nhỏ, landing page chạy quảng cáo, và đồ án tốt nghiệp/source Laravel.

## Requirements
- Tạo model `PricingPackage`.
- Có các gói basic, standard, premium.
- Field: name, slug, audience_type, package_type, price, description, features json, delivery_days, revisions, support_channels, is_active, sort_order.
- Có gói cho shop nhỏ: giới thiệu, catalog, bán hàng đơn giản.
- Có gói landing page: form lead, Zalo/Facebook CTA, tracking-ready.
- Có gói đồ án tốt nghiệp: source Laravel, database mẫu, báo cáo, hướng dẫn cài đặt/chạy.
- Admin CRUD pricing package.
- Public hiển thị gói active trên homepage/detail/order form.
- Có seeder gói mặc định.

## Files Expected
- `video-generator-app/app/Models/PricingPackage.php`
- `video-generator-app/database/migrations/*create_pricing_packages_table.php`
- `video-generator-app/database/seeders/PricingPackageSeeder.php`
- `video-generator-app/app/Http/Controllers/Admin/PricingPackageController.php`
- `video-generator-app/app/Http/Requests/StorePricingPackageRequest.php`
- `video-generator-app/app/Http/Requests/UpdatePricingPackageRequest.php`
- `video-generator-app/resources/views/admin/pricing-packages/*`
- `video-generator-app/tests/Feature/AdminPricingPackageTest.php`

## Implementation Notes
- Dùng casts cho features array.
- Price lưu nhất quán với module template.
- Slug unique.
- Admin only cho CRUD.

## Done When
- Admin quản lý gói giá.
- Seeder tạo các gói mặc định cho shop nhỏ, landing page và đồ án.
- Public có thể hiển thị package active.

## Test Requirements
- Test seeder hoặc factory tạo gói.
- Test admin CRUD.
- Test validation audience_type/package_type/price/features.
- Test inactive package không hiển thị public.

## Suggested Git Commit Message
- `feat: add pricing package management`
