# Task: Video Preview And Download

## Status
pending

## Priority
high

## Objective
Cho phép user preview và download video đã render, kèm authorization để chỉ owner mới truy cập được.

## Requirements
- Có trang hoặc endpoint preview video
- Có endpoint download video
- Chỉ owner được xem/tải video của mình
- Xử lý file path an toàn

## Files Expected
- controller preview/download
- route preview/download
- policy hoặc authorization logic
- view preview nếu là web flow
- test authorization và download
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Không expose trực tiếp file path nội bộ nếu có thể stream qua controller
- Dùng policy cho `VideoProject`
- Cân nhắc signed URL hoặc response download an toàn nếu phù hợp

## Done When
- Owner preview và download được video
- User khác không truy cập được
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature test owner xem preview được
- Feature test non-owner bị chặn
- Feature test download response đúng
