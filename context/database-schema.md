# Database Schema

Dùng file này để mô tả schema database ở mức tổng quan để Codex có thể hiểu nhanh data model trước khi code.

## Tables

- `users`
  - thông tin đăng nhập cơ bản
  - có `is_admin` boolean default false cho phân quyền admin tối giản
- `video_projects`
  - thuộc về `users`
  - hiện có: `id`, `user_id`, `keyword`, `content_brief`, `tone`, `duration_seconds`, `platform`, `language`, `status`, `progress_percent`, `error_message`, `script_content`, `audio_disk`, `audio_path`, `audio_duration_seconds`, `subtitle_disk`, `subtitle_path`, `rendered_video_path`, timestamps
  - status được cast bằng `VideoProjectStatusEnum`
  - `script_content` được ghi bởi `ScriptGenerationService` qua provider abstraction
  - `audio_*` được ghi bởi `VoiceOverGenerationService` qua TTS provider abstraction
  - `subtitle_*` được ghi bởi `SubtitleGenerationService` dưới dạng SRT
  - `rendered_video_path` được ghi bởi `VideoRenderService` qua render provider abstraction
- `video_scenes`
  - thuộc về `video_projects`
  - hiện có: `id`, `video_project_id`, `sort_order`, `text`, `duration_seconds`, `visual_prompt`, `status`, timestamps
  - status được cast bằng `VideoSceneStatusEnum`
- `video_assets`
  - thuộc về `video_projects` hoặc `video_scenes`
  - hiện có: `id`, `video_project_id`, `video_scene_id`, `type`, `disk`, `path`, `source`, `metadata`, timestamps
  - type được cast bằng `VideoAssetTypeEnum`
  - output render được lưu dưới type `output`
- `jobs`
  - dùng cho database queue nếu chọn queue driver là database
- `failed_jobs`
  - log job lỗi
- `notifications`
  - database notification của user, hiện dùng cho render completed notification

## Relationships

- `users` 1-n `video_projects`
- `video_projects` 1-n `video_scenes`
- `video_projects` 1-n `video_assets` nếu asset ở cấp project
- `video_scenes` 1-n `video_assets` nếu asset gắn theo scene
- `users` 1-n `notifications`

## Important Constraints

- `video_projects.user_id` phải có foreign key và index
- `video_projects.status` dùng string enum cast và có composite index với `user_id`
- `video_projects` có index `user_id, created_at` cho dashboard owner listing
- `video_scenes.video_project_id` phải có foreign key và index
- `video_scenes.sort_order` có unique composite với `video_project_id` để đảm bảo thứ tự render
- File path lưu trong DB phải là relative path an toàn thay vì absolute local path nếu có thể
- Multi-step pipeline update nên đi qua transaction hoặc service tập trung khi có nhiều write liên tiếp

## Notes

- Đây là schema sơ bộ cho MVP.
- Laravel app đã được khởi tạo trong `video-generator-app/`.
- Hiện có migration mặc định của Laravel cho `users`, `cache`, `jobs`, và `failed_jobs`, migration bổ sung `users.is_admin`, migration `video_projects`, `video_scenes`, `video_assets`, và `notifications`.
