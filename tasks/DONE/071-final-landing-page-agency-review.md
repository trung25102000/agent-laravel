# Task: Final Landing Page Agency Review

## Status
completed

## Priority
high

## Objective
Chạy vòng review cuối cho toàn bộ chuỗi task UI/conversion để đảm bảo homepage và public pages đạt cảm giác agency chuyên nghiệp, nhất quán và không regress về performance/accessibility.

## Requirements
- Review toàn bộ output từ các task UI/conversion mới và các task domain liên quan.
- Kiểm tra:
  - visual consistency
  - conversion flow
  - performance
  - mobile
  - accessibility cơ bản
  - reduced motion
  - CTA correctness
- Chạy các agent review liên quan:
  - security
  - testing
  - refactor
  - documentation
  - devops nếu asset/runtime thay đổi đáng kể
- Sửa toàn bộ issue trước khi đóng.

## Subtasks
- Audit public routes chính sau toàn bộ thay đổi.
- Chạy full validation.
- Browser smoke test desktop/mobile.
- Cập nhật docs/.agents/memory/.agents/context nếu cần.

## Files Expected
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/memory/bugs.md`
- `.agents/context/project-context.md`
- `seo-web-app/README.md`

## Implementation Notes
- Nếu phát hiện gap lớn mới, tạo task riêng thay vì nhét vào task review cuối.
- Task này nên chạy sau khi các task UI/conversion chính đã xong.

## Done When
- Không còn issue lớn về UI/conversion trong chuỗi task mới.
- Tài liệu và memory phản ánh đúng trạng thái cuối.

## Test Requirements
- `composer dump-autoload`
- `php artisan migrate`
- `php artisan test`
- `npm run build`
- `vendor/bin/pint`

## Suggested Git Commit Message
- chore: finalize agency-grade landing page review
