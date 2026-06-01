# Task: Git Push

## Status
completed

## Priority
high

## Objective
Kiểm tra trạng thái Git, bảo đảm test pass và không có file nhạy cảm trước khi commit/push toàn bộ MVP website bán template/dịch vụ làm web lên remote.

## Requirements
- Không push nếu test fail.
- Không push nếu còn file nhạy cảm như `.env`, secret, API key, credential.
- Kiểm tra remote bằng:
  - `git remote -v`
- Nếu chưa có remote thì dừng và ghi blocker vào `.agents/memory/progress.md` và `.agents/memory/bugs.md`.
- Kiểm tra branch hiện tại.
- Chạy `git status --short`.
- Chạy `git diff --check`.
- Chạy validation cuối:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
- `git add` đúng phạm vi.
- `git commit` với message đề xuất.
- Push branch hiện tại lên origin.

## Files Expected
- Git metadata/local repo
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`

## Implementation Notes
- Commit message đề xuất:
  - `feat: complete website template marketplace MVP`
- Không dùng `git reset --hard`.
- Không revert thay đổi của user.
- Nếu remote cần auth hoặc push fail, ghi rõ blocker và không giả vờ đã push.
- Sau push, xác nhận commit hash và remote branch.

## Done When
- Working tree clean sau commit/push.
- Remote origin có commit mới.
- User nhận được commit hash và branch đã push.
- Memory cập nhật trạng thái hoàn tất.

## Test Requirements
- Bắt buộc test pass trước khi push.
- Bắt buộc `git diff --check` pass.
- Bắt buộc kiểm tra không stage `.env`.

## Suggested Git Commit Message
- `feat: complete website template marketplace MVP`
