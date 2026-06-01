# Task: Testing Suite

## Status
completed

## Priority
high

## Objective
Bổ sung và chuẩn hóa test suite cho các module chính: public pages, admin CRUD, order request, contact, authorization và regression quan trọng.

## Requirements
- Feature tests cho homepage, listing, detail template.
- Feature tests cho admin CRUD category/template/pricing/blog.
- Feature tests cho order request và contact.
- Test authorization admin.
- Test validation fail.
- Test public chỉ thấy active/published content.
- Test media upload nếu module đã có.
- Suite chạy ổn định, không phụ thuộc external service.

## Files Expected
- `video-generator-app/tests/Feature/*`
- `video-generator-app/tests/Unit/*`
- `video-generator-app/database/factories/*`
- `video-generator-app/phpunit.xml`
- `.agents/memory/progress.md`

## Implementation Notes
- Dùng factory để tạo dữ liệu tối giản.
- Dùng `Storage::fake`, `Mail::fake`, `withoutVite` khi phù hợp.
- Không test chi tiết CSS quá mức.

## Done When
- Các module chính có test.
- `php artisan test` pass.
- Coverage hành vi quan trọng đủ để refactor an toàn.

## Test Requirements
- Chạy toàn bộ `php artisan test`.
- Không có skipped test không có lý do.
- Không phụ thuộc network.

## Suggested Git Commit Message
- `test: expand marketplace feature coverage`
