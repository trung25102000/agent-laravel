# Task: Video Project Model

## Status
completed

## Priority
high

## Objective
Thiết kế model trung tâm `VideoProject` để quản lý toàn bộ vòng đời tạo video của user.

## Requirements
- Tạo migration cho bảng `video_projects`
- Tạo model `VideoProject`
- Có trạng thái: `draft`, `queued`, `scripting`, `rendering`, `completed`, `failed`
- Lưu các field đầu vào cơ bản: keyword, nội dung mong muốn, tone, duration, platform, language
- Liên kết với user owner
- Có casts, fillable, relationships rõ ràng

## Files Expected
- migration tạo `video_projects`
- `app/Models/VideoProject.php`
- enum trạng thái nếu phù hợp
- factory nếu cần
- test model/migration
- `context/database-schema.md`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Dùng PHP Enum cho trạng thái nếu version/framework hỗ trợ tốt
- Cân nhắc thêm `status`, `progress_percent`, `error_message`, `script_content`, `rendered_video_path` ở mức hợp lý cho MVP hoặc để task sau bổ sung
- Tạo index cho `user_id`, `status`, timestamps nếu cần

## Done When
- Model và migration hoạt động đúng
- Quan hệ user -> video projects rõ ràng
- Trạng thái được quản lý bằng cấu trúc dễ mở rộng
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature hoặc unit test xác nhận tạo `VideoProject`
- Test relationship với `User`
- Test cast/enum trạng thái nếu có
