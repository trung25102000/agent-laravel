# Task: Landing Page Pricing Page

## Status
completed

## Priority
high

## Objective
Tạo trang gói landing page cho cá nhân kinh doanh online cần chạy quảng cáo, thu lead và liên hệ Zalo/Facebook nhanh.

## Requirements
- Route public `GET /pricing/landing-page`.
- Hiển thị gói landing page basic/standard/premium.
- Nêu rõ lợi ích: chốt đơn, form thu lead, nút Zalo/Facebook, tối ưu mobile, tốc độ nhanh.
- Có section mẫu landing page nổi bật.
- CTA yêu cầu tư vấn/chạy quảng cáo.
- FAQ cho cá nhân kinh doanh online.

## Files Expected
- `video-generator-app/app/Http/Controllers/LandingPagePricingController.php`
- `video-generator-app/resources/views/pricing/landing-page.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/LandingPagePricingTest.php`

## Implementation Notes
- Dùng pricing package `audience_type=online_seller` hoặc `package_type=landing_page`.
- CTA dẫn tới quote form và contact nhanh.
- Nội dung nên dễ hiểu, tránh thuật ngữ kỹ thuật nặng.

## Done When
- Trang gói landing page hoạt động.
- Có CTA Zalo/Facebook/form lead.
- Gói active hiển thị đúng.

## Test Requirements
- Test page 200.
- Test có nội dung form thu lead, Zalo/Facebook.
- Test hiển thị package active.

## Suggested Git Commit Message
- `feat: add landing page pricing page`
