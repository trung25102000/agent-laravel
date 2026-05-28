# Task: Tách test suite và validation cho từng app

## Status
completed

## Priority
medium

## Objective
Mỗi app có test suite độc lập và lệnh validation rõ ràng, giúp developer chạy đúng test cho từng source sau khi tách.

## Requirements
- `seo-web-app/tests` chỉ test marketplace.
- `video-generator-app/tests` chỉ test video generator.
- Không có test SEO-web gọi model/route video.
- Không có test video gọi model/route SEO-web.
- Cập nhật README root với lệnh test từng app.
- Nếu có CI sau này, định nghĩa matrix hoặc script riêng:
  - `test:seo-web`
  - `test:video-generator`

## Files Expected
- `/seo-web-app/tests/Feature/*`
- `/seo-web-app/tests/Unit/*`
- `/video-generator-app/tests/Feature/*`
- `/video-generator-app/tests/Unit/*`
- `/README.md`
- Có thể tạo script trong root như `/scripts/test-all.sh`

## Implementation Notes
- Dùng `RefreshDatabase` cho feature tests cần DB.
- Với SEO-web cần cover public pages, forms, admin authorization.
- Với video cần cover auth, video project CRUD, pipeline, API, preview/download, render job.

## Done When
- `php artisan test` pass trong cả hai app.
- Root README có hướng dẫn chạy test từng app.
- Không còn test fail do thiếu bảng của app còn lại.

## Test Requirements
- `/seo-web-app`: `composer dump-autoload && php artisan test`
- `/video-generator-app`: `composer dump-autoload && php artisan test`

## Suggested Git Commit Message
- test: split validation suites for standalone Laravel apps
