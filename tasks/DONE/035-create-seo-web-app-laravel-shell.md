# Task: Tạo Laravel app riêng cho seo-web

## Status
completed

## Priority
high

## Objective
Tạo thư mục source riêng `/seo-web-app` là một Laravel app độc lập để chứa website bán template/dịch vụ làm web, không còn chạy chung trong `video-generator-app`.

## Requirements
- Tạo Laravel app mới trong `/seo-web-app`.
- Dùng Laravel version mới nhất theo rules repo, tương thích PHP local hiện tại.
- Cấu hình `.env.example` riêng cho seo-web:
  - `APP_NAME="SEO Web Marketplace"`
  - database riêng, ví dụ `seo_web.sqlite` hoặc connection riêng MySQL/PostgreSQL.
  - mail/contact config riêng.
- Cấu hình Vite/Tailwind riêng.
- Copy hoặc dựng lại auth/admin tối giản cần cho admin SEO-web.
- Tạo README riêng trong `/seo-web-app`.
- Không xóa hoặc phá `/video-generator-app`.

## Files Expected
- `/seo-web-app/composer.json`
- `/seo-web-app/package.json`
- `/seo-web-app/.env.example`
- `/seo-web-app/README.md`
- `/seo-web-app/routes/web.php`
- `/seo-web-app/resources/views/layouts/app.blade.php`
- `/seo-web-app/resources/css/app.css`
- `/seo-web-app/tests/Feature/ExampleTest.php`

## Implementation Notes
- Nếu dùng `composer create-project`, cần đảm bảo không ghi đè root repo.
- Nếu tạo bằng cách clone/copy từ app hiện tại, phải loại bỏ ngay các file video ở task sau, không để lẫn domain lâu dài.
- Auth có thể dùng implementation thủ công hiện tại hoặc Laravel starter phù hợp, nhưng phải giữ đơn giản.
- Database local cho seo-web nên độc lập với video app để tránh migrations đụng nhau.

## Done When
- `/seo-web-app` tồn tại và chạy được `composer install`.
- `php artisan key:generate`, `php artisan migrate`, `php artisan test` chạy được trong `/seo-web-app`.
- Route `/` trả về landing page placeholder hoặc marketplace homepage.
- `/video-generator-app` vẫn chạy test như trước.

## Test Requirements
- Trong `/seo-web-app`:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
- Trong `/video-generator-app`:
  - `php artisan test`

## Suggested Git Commit Message
- chore: create standalone seo web Laravel app
