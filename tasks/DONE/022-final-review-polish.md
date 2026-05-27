# Task: Final Review Polish

## Status
completed

## Priority
high

## Objective
Rà soát cuối cùng toàn bộ website marketplace, polish UI/UX, refactor nhỏ, chạy test/formatter và bảo đảm tuân thủ rules trước khi chuẩn bị push Git.

## Requirements
- Chạy toàn bộ test.
- Chạy Laravel Pint nếu project có cấu hình.
- Rà UI public/admin các trang chính.
- Refactor code trùng lặp hoặc sai responsibility.
- Kiểm tra rules security/testing/frontend/documentation.
- Kiểm tra no pending migration lỗi.
- Kiểm tra không có debug dump/log tạm.
- Cập nhật `memory/progress.md`.

## Files Expected
- `video-generator-app/*`
- `memory/progress.md`
- `memory/changelog.md`
- `memory/bugs.md` nếu phát hiện bug
- `context/decisions.md` nếu có decision

## Implementation Notes
- Không refactor lớn sát cuối nếu không cần.
- Ưu tiên fix bug/risk rõ ràng.
- Nếu Pint thay đổi nhiều file, kiểm tra không phá logic.

## Done When
- `composer dump-autoload` pass.
- `php artisan migrate` pass.
- `php artisan test` pass.
- Pint/format pass nếu dùng.
- Không còn task triển khai pending ngoài git push.

## Test Requirements
- Chạy full `php artisan test`.
- Chạy smoke public pages nếu có thể.
- Chạy `git diff --check`.

## Suggested Git Commit Message
- `chore: polish marketplace MVP`
