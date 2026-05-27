# Task: Project Foundation

## Status
completed

## Priority
high

## Objective
Thiết lập nền tảng Laravel cho website bán template và dịch vụ làm web, bảo đảm cấu trúc dự án rõ ràng, cấu hình môi trường đầy đủ, layout chính và navigation cơ bản sẵn sàng cho các module tiếp theo.

## Requirements
- Xác định app directory hiện tại và không đặt source Laravel trực tiếp ở root agent nếu project đang dùng thư mục ứng dụng riêng.
- Kiểm tra phiên bản PHP 8.3+ và Laravel 11/12 hoặc tương thích với project hiện tại.
- Cấu hình `.env.example` cho database, mail, storage, app URL, admin seed.
- Thiết lập layout Blade hoặc Inertia theo stack hiện tại.
- Tạo navigation public cơ bản: Trang chủ, Mẫu web, Dịch vụ, Blog, Liên hệ.
- Tạo navigation admin placeholder nếu auth admin đã có hoặc để route bảo vệ ở task sau.
- Cấu hình TailwindCSS/Vite đúng chuẩn project.
- Cập nhật context về mục tiêu mới: website template marketplace và dịch vụ làm web.

## Files Expected
- `video-generator-app/.env.example`
- `video-generator-app/config/app.php`
- `video-generator-app/resources/views/layouts/app.blade.php`
- `video-generator-app/resources/views/components/*`
- `video-generator-app/resources/css/app.css`
- `video-generator-app/routes/web.php`
- `context/project-context.md`
- `context/routes-map.md`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên dùng Blade + Tailwind nếu project hiện tại đã dùng Blade.
- Không thêm package UI lớn nếu Tailwind hiện tại đủ đáp ứng.
- Tạo layout trung tính, dễ mở rộng cho public page và admin page.
- Không hard-code URL, email, phone trong view nếu có thể đưa vào config.
- Giữ controller mỏng, route public đơn giản trong giai đoạn foundation.

## Done When
- App chạy được trang chủ placeholder.
- Layout chính render không lỗi Vite.
- Navigation public hiển thị đầy đủ link cơ bản.
- `.env.example` có đủ biến cần thiết cho setup local.
- Context/memory được cập nhật đúng trạng thái dự án mới.

## Test Requirements
- Feature test trang chủ public trả HTTP 200.
- Test layout không lỗi khi guest truy cập.
- Chạy `composer dump-autoload`, `php artisan migrate`, `php artisan test`.

## Suggested Git Commit Message
- `chore: setup website marketplace foundation`
