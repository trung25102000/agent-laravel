# Task: Portfolio And Case Study Module

## Status
completed

## Priority
high

## Objective
Tạo khu vực portfolio/dự án đã làm để tăng trust và giúp khách hàng hiểu năng lực triển khai thực tế.

## Requirements
- Tạo trang portfolio hoặc case studies public.
- Mỗi dự án nên có:
  - tên dự án
  - loại dự án
  - bài toán khách hàng
  - giải pháp thực hiện
  - công nghệ dùng
  - ảnh/mockup/demo URL nếu có
  - kết quả hoặc lợi ích đạt được
  - trạng thái publish
- Tận dụng `demo_projects` hiện có nếu phù hợp, hoặc refactor thành module rõ nghĩa hơn cho service platform.
- Homepage và service pages cần link được tới portfolio.
- Admin có thể quản lý dữ liệu dự án ở mức cơ bản.

## Files Expected
- `seo-web-app/app/Models/DemoProject.php` hoặc module thay thế phù hợp
- `seo-web-app/app/Http/Controllers/MarketplaceController.php`
- `seo-web-app/resources/views/marketplace/portfolio/index.blade.php`
- `seo-web-app/resources/views/marketplace/portfolio/show.blade.php`
- `seo-web-app/resources/views/admin/marketplace/demo-projects.blade.php`
- `seo-web-app/tests/Feature/PortfolioCaseStudyTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Ưu tiên naming/public copy dễ hiểu hơn “demo projects” nếu module đang phục vụ vai trò portfolio.
- Không dùng dữ liệu giả kém thuyết phục; seed nên sát nhóm dịch vụ thật.

## Done When
- Có public portfolio page và detail page.
- Có ít nhất vài case study seed hợp lý.
- Admin có thể xem/quản lý nội dung cơ bản.

## Test Requirements
- Test portfolio index/show.
- Test unpublished item không public.
- Test admin access.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: add portfolio and case study module
