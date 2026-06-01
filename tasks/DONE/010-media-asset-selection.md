# Task: Media Asset Selection

## Status
completed

## Priority
medium

## Objective
Tạo cơ chế chọn hoặc gợi ý background image/video cho từng scene bằng mock provider hoặc rule-based selector.

## Requirements
- Có service chọn asset theo `visual_prompt`
- Lưu asset list cho từng scene hoặc project
- Hỗ trợ loại image/video
- Có mock source hoặc local placeholder assets

## Files Expected
- service/action asset selection
- model/bảng `video_assets` hoặc tương đương nếu cần
- provider interface nếu cần abstraction
- test asset selection
- `.agents/context/database-schema.md`
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`

## Implementation Notes
- MVP có thể dùng placeholder library hoặc selector đơn giản
- Tách logic source selection khỏi business flow để sau này tích hợp stock media API

## Done When
- Asset list được gợi ý hoặc gán cho scene/project
- Cấu trúc dữ liệu đủ dùng cho bước rendering
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test service chọn asset
- Integration test lưu asset list đúng vào database nếu có
