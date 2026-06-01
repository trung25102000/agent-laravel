# Task: Final review và push code tách source

## Status
completed

## Priority
high

## Objective
Rà soát toàn bộ thay đổi tách source, đảm bảo test pass ở cả hai app, không lộ file nhạy cảm, rồi commit/push lên remote.

## Requirements
- Chạy validation cả hai app:
  - `/seo-web-app`: `composer dump-autoload`, `php artisan migrate`, `php artisan test`, `npm run build`
  - `/video-generator-app`: `composer dump-autoload`, `php artisan migrate`, `php artisan test`, `npm run build`
- Chạy review theo agents:
  - security
  - testing
  - refactor
  - documentation
  - devops nếu có đổi env/deploy/queue/storage
- Kiểm tra `git status`.
- Không commit/push `.env`, storage private, vendor, node_modules, build artifact không cần thiết.
- Kiểm tra remote:
  - `git remote -v`
- Nếu chưa có remote thì dừng và ghi blocker.
- Commit message đề xuất:
  - `refactor: split seo web and video generator apps`
- Push branch hiện tại lên `origin`.

## Files Expected
- `/.agents/memory/progress.md`
- `/.agents/memory/changelog.md`
- `/.agents/memory/bugs.md` nếu có lỗi đã xử lý
- Git commit chứa toàn bộ thay đổi tách source

## Implementation Notes
- Không push nếu test fail.
- Không push nếu còn file nhạy cảm như `.env`.
- Nếu có thay đổi Pint/format nhiều file cũ, đảm bảo test pass sau format.

## Done When
- Cả hai app test/build pass.
- Không còn task pending của phase tách source nếu workflow được thực hiện.
- Code đã được push lên remote.
- Final message nêu commit hash, branch, URL SEO-web nếu server đang chạy.

## Test Requirements
- Full validation cả hai app như phần Requirements.

## Suggested Git Commit Message
- refactor: split seo web and video generator apps
