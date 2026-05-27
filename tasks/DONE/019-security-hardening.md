# Task: Security Hardening

## Status
completed

## Priority
high

## Objective
Rà soát và gia cố bảo mật toàn bộ website bán template/dịch vụ web trước khi polish cuối.

## Requirements
- Kiểm tra CSRF cho form web.
- Kiểm tra validation toàn bộ form public/admin.
- Kiểm tra authorization admin routes.
- Rate limit form public: contact, order.
- Không expose dữ liệu nhạy cảm như email khách trong public.
- Không expose path storage nội bộ.
- Kiểm tra upload media chống file nguy hiểm.
- Kiểm tra admin seed không hard-code secret production.
- Kiểm tra mass assignment.

## Files Expected
- `video-generator-app/app/Http/Requests/*`
- `video-generator-app/app/Policies/*`
- `video-generator-app/app/Providers/AppServiceProvider.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/routes/api.php`
- `video-generator-app/tests/Feature/SecurityHardeningTest.php`
- `memory/bugs.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên thêm tests cho bug/risk phát hiện.
- Không thay đổi kiến trúc lớn nếu không cần.
- Nếu phát hiện blocker, ghi rõ trong memory.

## Done When
- Không còn route admin hở.
- Public form có validation/rate limit.
- Upload được kiểm soát.
- Security tests pass.

## Test Requirements
- Test guest/non-admin không vào admin.
- Test public form rate limit.
- Test API không expose field nhạy cảm.
- Test upload reject file nguy hiểm.

## Suggested Git Commit Message
- `test: harden marketplace security`
