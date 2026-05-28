# Task: Làm sạch video-generator-app chỉ còn domain tạo video

## Status
completed

## Priority
high

## Objective
Sau khi `seo-web-app` chạy độc lập, loại bỏ marketplace SEO-web khỏi `video-generator-app` để app này chỉ còn chức năng tạo video AI.

## Requirements
- Xóa marketplace routes khỏi `video-generator-app/routes/web.php`.
- Khôi phục hoặc tạo landing page riêng cho video generator tại `/`.
- Xóa controllers marketplace khỏi video app.
- Xóa models marketplace khỏi video app.
- Xóa FormRequests/services/config/views marketplace khỏi video app.
- Xóa marketplace migration/seeders khỏi video app nếu chưa từng deploy production; nếu đã deploy, tạo migration rollback/cleanup có kiểm soát thay vì xóa migration lịch sử.
- Admin `/admin` của video app quay lại dashboard video projects.
- Giữ nguyên:
  - auth/register/login/logout
  - dashboard video
  - video project CRUD
  - status/preview/stream/download
  - API video
  - queue/render/FFmpeg services

## Files Expected
- `/video-generator-app/routes/web.php`
- `/video-generator-app/resources/views/welcome.blade.php`
- `/video-generator-app/resources/views/layouts/app.blade.php`
- Xóa hoặc cập nhật:
  - `/video-generator-app/app/Http/Controllers/MarketplaceController.php`
  - `/video-generator-app/app/Http/Controllers/Admin/MarketplaceAdminController.php`
  - `/video-generator-app/app/Models/*marketplace*`
  - `/video-generator-app/resources/views/marketplace/**`
  - `/video-generator-app/resources/views/admin/marketplace/**`
  - `/video-generator-app/config/contact.php`

## Implementation Notes
- Chỉ xóa code marketplace sau khi test `seo-web-app` pass.
- Cẩn thận không xóa component dùng chung nếu video app còn dùng layout/component đó.
- Nếu database local đã migrate marketplace tables, không cần ép drop ở dev nếu việc xóa migration làm test sạch pass; production cần task migration cleanup riêng.

## Done When
- `video-generator-app` không còn route public marketplace.
- `video-generator-app` không còn class/view/config SEO-web.
- Trang `/` của video app giới thiệu AI video generator rõ ràng.
- `php artisan test` trong video app pass.

## Test Requirements
- Existing video tests pass.
- Thêm hoặc cập nhật test landing video.
- Chạy:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`

## Suggested Git Commit Message
- refactor: clean video generator app after seo web extraction
