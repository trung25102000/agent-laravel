# Task: Final Review And Polish

## Status
completed

## Priority
high

## Objective
Chạy vòng hoàn thiện cuối cho toàn bộ MVP: test, refactor, rà soát rules, và cập nhật memory/context còn thiếu.

## Requirements
- Chạy toàn bộ test
- Refactor phần còn thô hoặc lặp
- Kiểm tra toàn bộ rules
- Chạy các review agent bắt buộc
- Cập nhật progress, changelog, bugs, decisions nếu cần

## Files Expected
- các file code cần polish nếu phát hiện vấn đề
- `memory/progress.md`
- `memory/changelog.md`
- `memory/bugs.md`
- `context/decisions.md`
- tài liệu/context liên quan nếu cần

## Implementation Notes
- Đây là task chốt MVP, không phải thêm tính năng lớn mới
- Ưu tiên xử lý technical debt trong phạm vi hợp lý
- Không move task vào DONE nếu còn fail security/test/convention

## Done When
- Toàn bộ test pass
- Review agents bắt buộc pass
- Không còn vi phạm rules rõ ràng
- Progress và tài liệu được cập nhật đúng

## Test Requirements
- `php artisan test` phải pass toàn bộ
- Nếu có job/queue flow, phải kiểm tra lại các test liên quan pipeline
