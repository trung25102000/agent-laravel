# Bugs Log

Dùng file này để lưu các bug, lỗi môi trường, lỗi test, hoặc regression mà Codex gặp trong quá trình làm task.

## Format

- Ngày:
- Task:
- Bug:
- Nguyên nhân:
- Cách sửa:
- Trạng thái:

## Entries

- Ngày: 2026-05-27
- Task: 001-project-foundation
- Bug: Local runtime chưa có PHP 8.5.
- Nguyên nhân: Máy hiện chạy PHP 8.4.7 qua Homebrew.
- Cách sửa: Bootstrap Laravel 13.11.2 với Composer constraint `php:^8.4` để dependency install và `php artisan test` chạy được; ghi workaround vào `context/decisions.md`.
- Trạng thái: Đã xử lý tạm thời, cần nâng runtime lên PHP 8.5 rồi đổi constraint về `php:^8.5` khi môi trường sẵn sàng.

- Ngày: 2026-05-27
- Task: 003-user-dashboard
- Bug: Feature test dashboard bị lỗi thiếu Vite manifest.
- Nguyên nhân: Test render layout có `@vite` nhưng asset frontend chưa được build trong môi trường test.
- Cách sửa: Gọi `$this->withoutVite()` trong dashboard feature test.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 017-error-handling-logging
- Bug: Render provider có thể throw raw infrastructure exception.
- Nguyên nhân: Trước task 017, `VideoRenderService` gọi provider trực tiếp và chưa map lỗi thành trạng thái pipeline an toàn.
- Cách sửa: Bọc render provider bằng try/catch, cập nhật project sang failed, log context an toàn, và throw `PipelineException`.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 019-security-review
- Bug: API/status trả `rendered_video_path`, làm lộ storage path nội bộ.
- Nguyên nhân: Resource/status payload ban đầu reuse field database cho response client.
- Cách sửa: Thay bằng `output_ready`, `preview_url`, `download_url`; thêm security tests.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 019-security-review
- Bug: Middleware `throttle:api` được thêm nhưng limiter `api` chưa được định nghĩa trong skeleton.
- Nguyên nhân: Laravel 13 skeleton không có RateLimiter mặc định cho `api` trong app provider.
- Cách sửa: Định nghĩa `RateLimiter::for('api')` trong `AppServiceProvider`.
- Trạng thái: Đã xử lý, `php artisan test` pass.
