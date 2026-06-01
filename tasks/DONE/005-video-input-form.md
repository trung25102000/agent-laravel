# Task: Video Input Form

## Status
completed

## Priority
high

## Objective
Tạo form để user nhập yêu cầu tạo video cho một `VideoProject`.

## Requirements
- Có form nhập:
  - keyword
  - nội dung mong muốn
  - tone
  - duration
  - platform
  - language
- Dùng `FormRequest` để validate
- Lưu dữ liệu vào `VideoProject`
- Hỗ trợ tạo project ở trạng thái `draft` hoặc `queued` tùy flow thiết kế

## Files Expected
- controller tạo/lưu video project
- `FormRequest` cho create/update
- route create/store
- view/form hoặc frontend component tương ứng
- test validation và create flow
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`

## Implementation Notes
- `platform` nên giới hạn trong tập TikTok, YouTube Shorts, Facebook Reels
- `duration` nên có rule rõ ràng, ví dụ số giây hoặc preset
- `tone` và `language` nên validate bằng enum hoặc danh sách cấu hình nếu phù hợp

## Done When
- User tạo được video project từ form
- Validation đầy đủ và lỗi hiển thị rõ
- Dữ liệu lưu đúng owner và đúng schema
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature test hiển thị form
- Feature test tạo project thành công
- Feature test validation fail cho dữ liệu thiếu hoặc sai platform
