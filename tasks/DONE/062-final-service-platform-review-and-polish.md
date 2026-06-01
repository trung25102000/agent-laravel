# Task: Final Service Platform Review And Polish

## Status
completed

## Priority
high

## Objective
Rà soát toàn bộ `seo-web-app` sau chuỗi task service-platform để bảo đảm tính nhất quán, bảo mật, test coverage, tài liệu và trải nghiệm chuyển đổi.

## Requirements
- Review lại toàn bộ public routes, admin lead workflow, schema, copy và CTA.
- Chạy đầy đủ review agents liên quan:
  - security
  - testing
  - refactor
  - documentation
  - database nếu có migration mới
  - api-contract nếu có đổi response/contract liên quan
- Sửa toàn bộ issue còn lại do review phát hiện.
- Cập nhật tài liệu và memory đầy đủ.

## Files Expected
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/memory/bugs.md`
- `.agents/context/project-context.md`
- `.agents/context/database-schema.md`
- `.agents/context/routes-map.md`
- `seo-web-app/README.md`

## Implementation Notes
- Task này không phải nơi thêm feature mới lớn, chỉ polish và đóng vòng.
- Nếu phát hiện phạm vi mới ngoài backlog, tạo task riêng thay vì nhét vào task cuối.

## Done When
- Không còn task pending liên quan chuỗi service-platform này.
- Validation pass và review agents không còn blocker.
- Docs, `.agents/context/`, và `.agents/memory/` phản ánh đúng trạng thái mới của `seo-web-app`.

## Test Requirements
- Chạy trong `seo-web-app`:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
  - `npm run build`
  - `vendor/bin/pint`

## Suggested Git Commit Message
- chore: finalize seo web service platform polish
