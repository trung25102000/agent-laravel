# Task: Scene Generation

## Status
pending

## Priority
high

## Objective
Tách script thành danh sách scene để phục vụ voice-over, subtitle, asset selection, và rendering.

## Requirements
- Tạo logic sinh scene list từ script
- Lưu scene list vào database
- Mỗi scene có tối thiểu:
  - text
  - duration
  - visual_prompt
- Có quan hệ với `VideoProject`
- Hỗ trợ thứ tự scene rõ ràng

## Files Expected
- migration tạo bảng `video_scenes` hoặc tương đương
- model `VideoScene`
- service/action scene generation
- test scene generation
- `context/database-schema.md`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Có thể dùng parser đơn giản cho MVP từ đoạn script
- `duration` scene nên cộng lại xấp xỉ duration tổng
- `visual_prompt` nên sinh ở dạng text rõ ràng cho bước asset selection

## Done When
- Scene list được tạo và lưu đúng thứ tự
- Quan hệ `VideoProject` -> scenes hoạt động
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test tách script thành scenes
- Feature hoặc integration test lưu scene list đúng số lượng và thứ tự
