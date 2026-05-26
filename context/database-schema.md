# Database Schema

Dùng file này để mô tả schema database ở mức tổng quan để Codex có thể hiểu nhanh data model trước khi code.

## Tables

- `users`
  - thông tin đăng nhập cơ bản
  - có thể bổ sung `is_admin` cho MVP
- `video_projects`
  - thuộc về `users`
  - lưu input như keyword, content_brief, tone, duration_seconds, platform, language
  - lưu trạng thái pipeline, progress, error_message, script_content, audio_path, subtitle_path, rendered_video_path
- `video_scenes`
  - thuộc về `video_projects`
  - lưu thứ tự scene, text, duration_seconds, visual_prompt
- `video_assets`
  - thuộc về `video_projects` hoặc `video_scenes`
  - lưu loại asset, nguồn, path/url, metadata tối giản
- `jobs`
  - dùng cho database queue nếu chọn queue driver là database
- `failed_jobs`
  - log job lỗi
- `notifications`
  - dùng cho database notification của user

## Relationships

- `users` 1-n `video_projects`
- `video_projects` 1-n `video_scenes`
- `video_projects` 1-n `video_assets` nếu asset ở cấp project
- `video_scenes` 1-n `video_assets` nếu asset gắn theo scene
- `users` 1-n `notifications`

## Important Constraints

- `video_projects.user_id` phải có foreign key và index
- `video_projects.status` nên dùng enum hoặc string chuẩn hóa, có index
- `video_scenes.video_project_id` phải có foreign key và index
- `video_scenes.sort_order` phải rõ ràng để đảm bảo thứ tự render
- File path lưu trong DB phải là relative path an toàn thay vì absolute local path nếu có thể
- Multi-step pipeline update nên đi qua transaction hoặc service tập trung khi có nhiều write liên tiếp

## Notes

- Đây là schema sơ bộ cho MVP.
- Tên cột chi tiết sẽ được chuẩn hóa khi Laravel app được khởi tạo và migration thật được viết.
