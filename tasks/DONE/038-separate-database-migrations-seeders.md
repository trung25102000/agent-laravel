# Task: Tách database migrations và seeders cho từng app

## Status
completed

## Priority
high

## Objective
Đảm bảo `video-generator-app` và `seo-web-app` có database schema, seeders, factories, tests độc lập, không cần chạy migrations của nhau.

## Requirements
- `seo-web-app` chỉ có migrations marketplace:
  - template categories
  - website templates
  - pricing packages
  - customers
  - order requests
  - quote requests
  - graduation project requests
  - contact messages
  - blog posts
  - source code products
  - demo projects
  - product attachments
  - faq items
  - users/auth/admin cần thiết
- `video-generator-app` chỉ có migrations video:
  - users/auth/admin
  - video projects
  - video scenes
  - video assets
  - jobs/notifications/cache
- Seeder riêng:
  - `seo-web-app`: `AdminUserSeeder`, `MarketplaceSeeder`.
  - `video-generator-app`: video demo/admin/user seed nếu cần.
- Factory/test fixtures riêng cho từng app.
- `.env.example` của mỗi app dùng database file/name riêng.

## Files Expected
- `/seo-web-app/database/migrations/**`
- `/seo-web-app/database/seeders/**`
- `/seo-web-app/database/factories/**`
- `/video-generator-app/database/migrations/**`
- `/video-generator-app/database/seeders/**`
- `/video-generator-app/database/factories/**`
- `/seo-web-app/.env.example`
- `/video-generator-app/.env.example`

## Implementation Notes
- Không dùng chung database trong local dev để tránh schema drift.
- Nếu cần giữ dữ liệu cũ, viết hướng dẫn export/import marketplace từ DB cũ sang DB mới.
- Các foreign key phải rõ ràng, reversible.

## Done When
- Fresh migrate của từng app chạy độc lập.
- Seeder từng app không gọi model/class của app còn lại.
- `php artisan migrate:fresh --seed` pass trong cả hai app.

## Test Requirements
- `/seo-web-app`: `php artisan migrate:fresh --seed && php artisan test`
- `/video-generator-app`: `php artisan migrate:fresh --seed && php artisan test`

## Suggested Git Commit Message
- refactor: separate database schemas for seo web and video apps
