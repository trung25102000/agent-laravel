# Task: Pricing Reference And Support Plans

## Status
completed

## Priority
medium

## Objective
Nâng cấp trang bảng giá để phản ánh đúng các dịch vụ mới: làm web, landing page, sửa giao diện, SEO, đồ án và task code nhỏ.

## Requirements
- Rà soát các `pricing_packages` hiện có và nhóm lại theo service platform.
- Bổ sung gói hoặc bảng giá tham khảo cho:
  - website cơ bản
  - landing page
  - fix/chỉnh sửa UI
  - SEO website
  - hỗ trợ đồ án
  - task code nhỏ
- Làm rõ phạm vi, không hard-sell giá cứng nếu thực tế cần khảo sát thêm.
- Có note về thời gian xử lý, những gì bao gồm/không bao gồm, support sau bàn giao.
- CTA từ bảng giá phải đẩy sang quote funnel phù hợp.

## Files Expected
- `seo-web-app/app/Models/PricingPackage.php`
- `seo-web-app/database/seeders/*Pricing*Seeder.php`
- `seo-web-app/resources/views/marketplace/pricing.blade.php`
- `seo-web-app/tests/Feature/PricingReferenceTest.php`

## Implementation Notes
- Nếu route `/pricing/{type}` hiện còn phù hợp thì mở rộng, nếu không phù hợp thì cập nhật routes map và redirect hợp lý.
- Giá trị nên trình bày rõ ràng, không gây hiểu nhầm như báo giá cố định tuyệt đối.

## Done When
- Bảng giá phản ánh đúng offer thật của website.
- Người dùng đọc xong hiểu sơ bộ mức giá và biết bước tiếp theo để nhận báo giá chính xác.

## Test Requirements
- Test pricing page render đúng nhóm dịch vụ/gói.
- Test CTA/links liên quan.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: refresh pricing reference for service platform
