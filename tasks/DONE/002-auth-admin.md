# Task: Auth Admin

## Status
completed

## Priority
high

## Objective
Xây dựng hệ thống đăng nhập và phân quyền admin để bảo vệ toàn bộ khu vực quản trị template, đơn hàng, khách hàng, blog và liên hệ.

## Requirements
- Có đăng nhập admin bằng email/password.
- Có cờ hoặc role admin rõ ràng, ví dụ `users.is_admin`.
- Có middleware/gate/policy để chặn non-admin.
- Có seeder tạo admin mặc định từ env hoặc config an toàn.
- Không commit mật khẩu thật hoặc secret.
- Admin logout được.
- Non-admin/guest không truy cập được admin dashboard.

## Files Expected
- `video-generator-app/app/Http/Controllers/Auth/*`
- `video-generator-app/app/Http/Requests/Auth/*`
- `video-generator-app/app/Providers/AppServiceProvider.php`
- `video-generator-app/database/migrations/*add_is_admin_to_users_table.php`
- `video-generator-app/database/seeders/AdminUserSeeder.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/resources/views/auth/login.blade.php`
- `video-generator-app/tests/Feature/AdminAuthTest.php`

## Implementation Notes
- Dùng Laravel Hash cho password.
- Dùng FormRequest cho validation login nếu có custom auth.
- Dùng Gate `access-admin` hoặc middleware `admin`.
- Seeder đọc email/password từ env qua config/seeder fallback an toàn cho local.
- Không expose lý do login fail quá chi tiết.

## Done When
- Admin đăng nhập được.
- Guest bị redirect khỏi `/admin`.
- User không phải admin bị 403 khỏi `/admin`.
- Seeder tạo admin local hoạt động.

## Test Requirements
- Test admin login thành công.
- Test guest không vào admin.
- Test non-admin bị forbidden.
- Test admin logout.
- Chạy `php artisan test`.

## Suggested Git Commit Message
- `feat: add admin authentication and access control`
