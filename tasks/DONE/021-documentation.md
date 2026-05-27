# Task: Documentation

## Status
completed

## Priority
medium

## Objective
Cập nhật tài liệu setup, vận hành, routes, schema và workflow để developer khác có thể chạy local, migrate/seed, test và deploy website marketplace.

## Requirements
- Cập nhật README.
- Hướng dẫn setup local.
- Hướng dẫn migrate/seed admin.
- Hướng dẫn chạy test.
- Hướng dẫn storage link/media upload.
- Hướng dẫn mail log/SMTP.
- Cập nhật `context/routes-map.md`.
- Cập nhật `context/database-schema.md`.
- Cập nhật `context/project-context.md` nếu domain đã đổi.
- Cập nhật memory/changelog/progress.

## Files Expected
- `README.md`
- `video-generator-app/README.md`
- `context/routes-map.md`
- `context/database-schema.md`
- `context/project-context.md`
- `memory/changelog.md`
- `memory/progress.md`

## Implementation Notes
- Tài liệu ngắn gọn, chạy được.
- Không ghi secret thật.
- Ghi rõ PHP/Laravel version thực tế.
- Ghi rõ command chạy từ `video-generator-app/`.

## Done When
- README đủ để setup local từ clone mới.
- Context phản ánh đúng routes/schema hiện tại.
- Memory cập nhật task completed/pending.

## Test Requirements
- Không có test code bắt buộc, nhưng phải chạy `php artisan test` sau doc nếu có thay đổi code liên quan.
- Kiểm tra link/command trong README hợp lý.

## Suggested Git Commit Message
- `docs: document marketplace setup and architecture`
