# Task: Security Review

## Status
completed

## Priority
high

## Objective
Rà soát và gia cố bảo mật cho toàn bộ MVP trước khi coi hệ thống là sẵn sàng sử dụng nội bộ.

## Requirements
- Kiểm tra authorization
- Kiểm tra validation
- Kiểm tra file access preview/download
- Kiểm tra rate limit cho endpoint cần thiết
- Khắc phục lỗ hổng tìm thấy trong phạm vi MVP

## Files Expected
- policy/middleware/request/rate limit files liên quan
- test security
- `memory/bugs.md`
- `memory/progress.md`
- `memory/changelog.md`
- `context/decisions.md`

## Implementation Notes
- Dùng review agent bảo mật trong repo làm checklist bắt buộc
- Nếu thấy issue nhỏ có thể sửa ngay, không ghi nhận suông
- Rate limiting có thể ưu tiên cho API tạo project hoặc polling status nếu cần

## Done When
- Không còn lỗ hổng rõ ràng trong phạm vi MVP
- Security review pass theo rules/agents
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature test authorization
- Feature test validation
- Feature test file access bị chặn khi không đúng owner
- Test rate limit nếu có áp dụng
