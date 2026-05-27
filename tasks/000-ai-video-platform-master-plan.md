# Task Plan: AI Video Generator Platform

## Status
planning

## 1. Phân Tích Yêu Cầu Sản Phẩm

### Mục tiêu người dùng

- Người dùng nhập một chủ đề ngẫu nhiên hoặc tự thiết kế ý tưởng video.
- Người dùng chọn phong cách, ngôn ngữ, giọng đọc, template, thời lượng, tỷ lệ video.
- Hệ thống tự động tạo video dọc MP4 9:16 có script, scene, ảnh/video nền, voice, subtitle, nhạc nền, và metadata social.
- Người dùng có thể xem tiến trình, preview, tải video, và quản lý lịch sử video đã tạo.

### Use case chính

- Đăng ký, đăng nhập, quản lý tài khoản.
- Tạo video project từ chủ đề.
- Chọn template, style, language, voice, duration.
- Preview script và cho phép regenerate/chỉnh sửa trong MVP nếu đủ thời gian.
- Theo dõi pipeline generate theo trạng thái.
- Preview/download output MP4.
- Admin theo dõi user, project, lỗi provider, queue, chi phí AI.
- Hệ thống retry hoặc đánh dấu lỗi khi AI/FFmpeg/storage thất bại.

### Role trong hệ thống

- Guest: xem landing/login/register.
- User: tạo project, xem video của chính mình, tải output, dùng credit.
- Admin: quản lý user/project/template/provider logs/credit.
- System Worker: xử lý queue jobs, gọi AI provider, render FFmpeg, cập nhật trạng thái.

### Phạm vi MVP

- Laravel 13 + PHP 8.5 trong `video-generator-app/`.
- Auth user/admin tối giản.
- CRUD video project.
- Pipeline thật qua queue Redis.
- OpenAI script generation qua provider interface.
- Image/TTS provider interface có mock + adapter thật khi có key.
- FFmpeg render MP4 dọc 1080x1920 từ ảnh + voice + subtitle.
- Local storage trước, S3 abstraction sẵn.
- Basic credit quota theo user.
- Admin panel tối giản bằng Filament hoặc Blade.
- Logging lỗi pipeline và retry thủ công.

### Phạm vi sau MVP

- Template editor nâng cao.
- Payment gateway và credit package.
- Multi-provider AI routing.
- AI video background thay vì ảnh tĩnh.
- Auto publish TikTok/Reels/Shorts.
- Team/workspace.
- Brand kit, reusable voice/style presets.
- Analytics video performance.

## 2. Thiết Kế Database

### Bảng chính

#### `users`

- `id`
- `name`
- `email`
- `email_verified_at`
- `password`
- `is_admin` boolean default false
- `credits_balance` integer default 0
- `timezone` nullable string
- `remember_token`
- `created_at`, `updated_at`

#### `video_templates`

- `id`
- `name`
- `slug` unique
- `description` nullable text
- `style` string
- `aspect_ratio` enum, default `9:16`
- `duration_min_seconds` integer
- `duration_max_seconds` integer
- `config` json
- `is_active` boolean
- `created_at`, `updated_at`

#### `voices`

- `id`
- `provider` string
- `provider_voice_id` string
- `name` string
- `language` string
- `gender` nullable enum
- `sample_url` nullable string
- `metadata` json nullable
- `is_active` boolean
- `created_at`, `updated_at`

#### `video_projects`

- `id`
- `user_id` foreign key
- `video_template_id` nullable foreign key
- `voice_id` nullable foreign key
- `title` nullable string
- `topic` text
- `style` string
- `language` string
- `duration_seconds` integer
- `aspect_ratio` enum default `9:16`
- `status` enum
- `progress_percent` unsigned tinyint default 0
- `current_step` nullable string
- `script` longText nullable
- `social_title` nullable string
- `social_description` nullable text
- `hashtags` json nullable
- `output_disk` nullable string
- `output_path` nullable string
- `thumbnail_path` nullable string
- `error_message` nullable text
- `failed_step` nullable string
- `credits_reserved` integer default 0
- `credits_charged` integer default 0
- `started_at`, `completed_at`, `failed_at` nullable timestamps
- `created_at`, `updated_at`

#### `video_scenes`

- `id`
- `video_project_id` foreign key
- `position` unsigned integer
- `title` nullable string
- `narration` text
- `visual_prompt` text nullable
- `image_disk` nullable string
- `image_path` nullable string
- `video_disk` nullable string
- `video_path` nullable string
- `duration_seconds` decimal(6,2)
- `status` enum
- `metadata` json nullable
- `created_at`, `updated_at`

#### `video_assets`

- `id`
- `video_project_id` foreign key
- `video_scene_id` nullable foreign key
- `type` enum: `image`, `video`, `voice`, `subtitle`, `music`, `thumbnail`, `output`
- `disk` string
- `path` string
- `mime_type` nullable string
- `size_bytes` nullable integer
- `duration_seconds` nullable decimal(8,2)
- `metadata` json nullable
- `created_at`, `updated_at`

#### `pipeline_logs`

- `id`
- `video_project_id` foreign key
- `step` string
- `status` enum: `started`, `completed`, `failed`, `retried`
- `message` nullable text
- `context` json nullable
- `duration_ms` nullable integer
- `created_at`

#### `ai_provider_requests`

- `id`
- `video_project_id` nullable foreign key
- `provider` string
- `operation` string
- `request_hash` nullable string
- `input_tokens` nullable integer
- `output_tokens` nullable integer
- `cost_cents` nullable integer
- `status` enum: `success`, `failed`
- `error_message` nullable text
- `metadata` json nullable
- `created_at`

#### `credit_transactions`

- `id`
- `user_id` foreign key
- `video_project_id` nullable foreign key
- `type` enum: `grant`, `reserve`, `charge`, `refund`, `adjust`
- `amount` integer
- `balance_after` integer
- `description` nullable string
- `metadata` json nullable
- `created_at`

### Relationship

- `User hasMany VideoProject`
- `User hasMany CreditTransaction`
- `VideoProject belongsTo User`
- `VideoProject belongsTo VideoTemplate`
- `VideoProject belongsTo Voice`
- `VideoProject hasMany VideoScene`
- `VideoProject hasMany VideoAsset`
- `VideoProject hasMany PipelineLog`
- `VideoScene belongsTo VideoProject`
- `VideoScene hasMany VideoAsset`

### Enum status

- `VideoProjectStatusEnum`: `draft`, `queued`, `generating_script`, `splitting_scenes`, `generating_assets`, `generating_voice`, `generating_subtitle`, `rendering`, `finalizing`, `completed`, `failed`, `cancelled`
- `VideoSceneStatusEnum`: `pending`, `generating`, `ready`, `failed`
- `VideoAssetTypeEnum`: `image`, `video`, `voice`, `subtitle`, `music`, `thumbnail`, `output`
- `PipelineLogStatusEnum`: `started`, `completed`, `failed`, `retried`
- `CreditTransactionTypeEnum`: `grant`, `reserve`, `charge`, `refund`, `adjust`

### Migration Laravel gợi ý

- `create_video_templates_table`
- `create_voices_table`
- `add_admin_and_credits_fields_to_users_table`
- `create_video_projects_table`
- `create_video_scenes_table`
- `create_video_assets_table`
- `create_pipeline_logs_table`
- `create_ai_provider_requests_table`
- `create_credit_transactions_table`

## 3. Thiết Kế Kiến Trúc Laravel

### Folder structure trong `video-generator-app/`

```text
app/
  Actions/VideoProjects/
  Actions/Pipeline/
  DTOs/
  Enums/
  Events/
  Exceptions/
  Http/Controllers/
  Http/Requests/
  Http/Resources/
  Jobs/
  Listeners/
  Models/
  Policies/
  Services/AI/
  Services/Rendering/
  Services/Storage/
  Services/Credits/
  Support/
config/
  video_pipeline.php
  ai.php
```

### Models

- `User`
- `VideoProject`
- `VideoScene`
- `VideoAsset`
- `VideoTemplate`
- `Voice`
- `PipelineLog`
- `AiProviderRequest`
- `CreditTransaction`

### Controllers

- `DashboardController`
- `VideoProjectController`
- `VideoProjectPipelineController`
- `VideoProjectPreviewController`
- `Api/VideoProjectController`
- `Admin/*` nếu dùng Blade; nếu dùng Filament thì dùng Resources.

### Services

- `ScriptGeneratorService`
- `ScenePlannerService`
- `ImageGenerationService`
- `TextToSpeechService`
- `SubtitleService`
- `FfmpegRenderService`
- `VideoPipelineOrchestrator`
- `StoragePathService`
- `CreditService`
- `AiCostTracker`

### Jobs

- `GenerateScriptJob`
- `SplitScenesJob`
- `GenerateImageAssetsJob`
- `GenerateVoiceJob`
- `GenerateSubtitleJob`
- `RenderVideoJob`
- `FinalizeVideoJob`
- `FailVideoProjectJob` nếu muốn gom xử lý fail.

### Events / Listeners

- `VideoProjectQueued`
- `VideoProjectStepStarted`
- `VideoProjectStepCompleted`
- `VideoProjectFailed`
- `VideoProjectCompleted`
- `NotifyUserVideoCompleted`
- `RefundCreditsOnFailure`

### Policies

- `VideoProjectPolicy`
- `VideoTemplatePolicy`
- `AdminPolicy` hoặc gate `admin`.

### Requests

- `StoreVideoProjectRequest`
- `UpdateVideoProjectRequest`
- `RegenerateScriptRequest`
- `StartVideoPipelineRequest`
- `Api/StoreVideoProjectRequest`

### Resources

- `VideoProjectResource`
- `VideoSceneResource`
- `VideoAssetResource`
- `PipelineLogResource`

## 4. Luồng Tạo Video AI

1. User tạo project với `topic`, `style`, `language`, `voice_id`, `template_id`, `duration_seconds`.
2. `StoreVideoProjectRequest` validate input và policy kiểm tra quota/credit.
3. `CreditService` reserve credit dự kiến.
4. Tạo `video_projects` status `queued`, progress `0`.
5. Dispatch `GenerateScriptJob`.
6. `GenerateScriptJob` gọi OpenAI qua `ScriptGeneratorService`, lưu script, title/hashtags, status `generating_script`.
7. Dispatch `SplitScenesJob`.
8. `SplitScenesJob` chia script thành scene, narration, visual prompt, duration.
9. Dispatch `GenerateImageAssetsJob`.
10. `GenerateImageAssetsJob` gọi image provider cho từng scene, lưu asset path.
11. Dispatch `GenerateVoiceJob`.
12. `GenerateVoiceJob` gọi TTS provider, lưu audio master hoặc audio từng scene.
13. Dispatch `GenerateSubtitleJob`.
14. `GenerateSubtitleJob` tạo `.srt`/`.vtt` từ scene timing hoặc transcript.
15. Dispatch `RenderVideoJob`.
16. `RenderVideoJob` chuẩn bị input manifest, gọi FFmpeg render MP4 1080x1920.
17. Dispatch `FinalizeVideoJob`.
18. `FinalizeVideoJob` lưu output asset, thumbnail, charge credit, status `completed`.
19. Fire event thông báo user.
20. Nếu lỗi ở bước nào: log `pipeline_logs`, update status `failed`, refund phần credit phù hợp, cho phép retry từ failed step.

## 5. Danh Sách Task Backend

### Authentication

- Cài auth Laravel 13 tương thích stack.
- Thêm `is_admin`, `credits_balance`.
- Policy/gate admin.
- Test register/login/logout/protected route.

### User dashboard

- Dashboard hiển thị tổng project, project gần đây, credit.
- Danh sách video project theo owner.
- Empty state và link tạo video.

### Video project CRUD

- Tạo `VideoProject`, `VideoScene`, `VideoAsset` models/migrations/enums.
- CRUD project draft.
- Start pipeline endpoint/action.
- Policy owner-only.

### AI script generation

- Provider interface.
- OpenAI adapter.
- Mock adapter cho test/local.
- Lưu request cost/log.
- Retry khi timeout/rate limit.

### Scene management

- Parse script thành scene.
- Lưu position, narration, visual prompt, duration.
- Validate tổng duration gần với target.

### Image generation

- Image provider interface.
- Generate ảnh từng scene.
- Store asset local/S3.
- Retry từng scene failed.

### Text-to-speech

- TTS provider interface.
- Generate voice theo language/voice.
- Lưu audio duration.
- Detect audio quá dài/ngắn.

### Subtitle generation

- Tạo SRT/VTT từ scene timings.
- Sanitize text.
- Sync với audio duration.

### FFmpeg rendering

- Build input manifest.
- Render ảnh + audio + subtitle thành 1080x1920 MP4.
- Generate thumbnail.
- Capture stderr/log.

### Queue processing

- Redis queue config.
- Chain jobs theo project.
- Retry/backoff/timeout riêng từng job.
- Retry failed project từ step.

### Storage management

- Path convention theo user/project.
- Local disk MVP.
- S3-ready config.
- Cleanup temp files.

### Credit/payment system

- Reserve/charge/refund credit.
- Basic admin grant credit.
- Transaction log.
- Payment integration sau MVP.

### Admin panel

- Quản lý users/projects/templates/voices.
- Xem pipeline logs.
- Retry failed project.
- Xem provider cost.

### Logging/error handling

- Custom exceptions provider/render/storage.
- Pipeline log theo step.
- Safe user-facing errors.
- Alert lỗi nghiêm trọng.

## 6. Danh Sách Task Frontend

- Trang nhập ý tưởng video: form topic/style/language/voice/template/duration.
- Trang chọn template: grid template, preview thumbnail, filter style.
- Trang preview script: hiển thị script/scene, regenerate hoặc approve.
- Trang progress: realtime polling hoặc broadcast, progress bar, current step.
- Trang preview video: video player, download, copy metadata TikTok.
- Trang quản lý video: list, filter status, duplicate project, delete.
- Admin UI: users, project monitor, failed jobs, templates, voices, credit grant.

## 7. API Design

### `POST /api/video-projects`

- Body: `topic`, `style`, `language`, `voice_id`, `video_template_id`, `duration_seconds`
- Response: `VideoProjectResource`
- Validation: required topic/style/language/duration, existing voice/template, duration min/max.
- Permission: authenticated user, enough credits.

### `GET /api/video-projects`

- Body: none
- Response: paginated `VideoProjectResource`
- Validation: `status` optional enum.
- Permission: authenticated, owner scope.

### `GET /api/video-projects/{videoProject}`

- Response: project + scenes + assets.
- Permission: owner or admin.

### `POST /api/video-projects/{videoProject}/start`

- Body: none or `confirm_script`.
- Response: accepted status.
- Validation: project must be `draft` or `failed` retryable.
- Permission: owner, enough credits.

### `GET /api/video-projects/{videoProject}/status`

- Response: `status`, `progress_percent`, `current_step`, `error_message`.
- Permission: owner or admin.

### `GET /api/video-projects/{videoProject}/result`

- Response: output URL, thumbnail URL, social title, description, hashtags.
- Validation: project completed.
- Permission: owner or admin.

### `POST /api/video-projects/{videoProject}/retry`

- Body: `from_step` optional.
- Response: accepted.
- Permission: owner if own failed project, admin all.

### `DELETE /api/video-projects/{videoProject}`

- Response: no content.
- Permission: owner or admin.

## 8. Queue Job Design

### GenerateScriptJob

- Input: `video_project_id`
- Output: `script`, social metadata.
- Retry: 3 attempts, exponential backoff `60, 180, 600`.
- Timeout: 120s.
- Error: mark failed step `generating_script`, log provider error, refund reservation if terminal.
- Status: `generating_script`, progress 10.

### SplitScenesJob

- Input: `video_project_id`
- Output: `video_scenes`.
- Retry: 2 attempts.
- Timeout: 60s.
- Error: mark failed step `splitting_scenes`.
- Status: `splitting_scenes`, progress 20.

### GenerateImageAssetsJob

- Input: `video_project_id`
- Output: image assets per scene.
- Retry: 3 attempts, per-scene idempotent checks.
- Timeout: 10 minutes.
- Error: mark scene failed, mark project failed if required scene missing.
- Status: `generating_assets`, progress 45.

### GenerateVoiceJob

- Input: `video_project_id`
- Output: voice audio asset.
- Retry: 3 attempts.
- Timeout: 5 minutes.
- Error: mark failed step `generating_voice`.
- Status: `generating_voice`, progress 60.

### GenerateSubtitleJob

- Input: `video_project_id`
- Output: `.srt` and/or `.vtt` asset.
- Retry: 2 attempts.
- Timeout: 60s.
- Error: mark failed step `generating_subtitle`.
- Status: `generating_subtitle`, progress 70.

### RenderVideoJob

- Input: `video_project_id`
- Output: temp MP4 + thumbnail.
- Retry: 2 attempts.
- Timeout: 20 minutes.
- Error: capture FFmpeg stderr, mark failed step `rendering`.
- Status: `rendering`, progress 90.

### FinalizeVideoJob

- Input: `video_project_id`
- Output: persisted output asset, charged credits, notification.
- Retry: 3 attempts.
- Timeout: 120s.
- Error: mark failed step `finalizing`; do not double-charge.
- Status: `finalizing` then `completed`, progress 100.

## 9. FFmpeg Rendering Plan

### Cấu trúc input

```text
storage/app/video-projects/{project_id}/
  images/scene-001.png
  images/scene-002.png
  audio/voice.mp3
  subtitles/subtitles.srt
  music/background.mp3
  render/output.mp4
```

### Ghép ảnh + audio

- Mỗi scene ảnh được loop theo `duration_seconds`.
- Scale/crop về 1080x1920.
- Concatenate scene clips.
- Mix voice + background music.

### Thêm subtitle

- MVP dùng `.srt` và FFmpeg subtitles filter.
- Font size lớn, safe margin cho mobile.

### Background music

- Music optional.
- Volume music khoảng `0.08 - 0.15`.
- Voice giữ `1.0`.

### Render 1080x1920

- Codec: `libx264`
- Pixel format: `yuv420p`
- FPS: 30
- Audio: AAC 128k/192k

### Command mẫu

```bash
ffmpeg -y \
  -loop 1 -t 4.5 -i scene-001.png \
  -loop 1 -t 5.0 -i scene-002.png \
  -i voice.mp3 \
  -i background.mp3 \
  -filter_complex "\
    [0:v]scale=1080:1920:force_original_aspect_ratio=increase,crop=1080:1920,setsar=1[v0];\
    [1:v]scale=1080:1920:force_original_aspect_ratio=increase,crop=1080:1920,setsar=1[v1];\
    [v0][v1]concat=n=2:v=1:a=0,format=yuv420p,subtitles=subtitles.srt[v];\
    [2:a]volume=1.0[voice];\
    [3:a]volume=0.12[music];\
    [voice][music]amix=inputs=2:duration=first:dropout_transition=2[a]" \
  -map "[v]" -map "[a]" \
  -r 30 -c:v libx264 -preset medium -crf 23 \
  -c:a aac -b:a 192k -shortest output.mp4
```

### Lỗi thường gặp

- Missing file: validate manifest trước render.
- Unsupported image/audio codec: normalize input bằng FFmpeg preflight.
- Subtitle font lỗi: dùng font có sẵn trên server hoặc bundled font.
- Audio dài hơn video: dùng `-shortest` hoặc điều chỉnh scene duration.
- FFmpeg timeout: tăng timeout job hoặc giảm resolution/preset.
- Memory/disk full: log usage, cleanup temp, giới hạn concurrent render workers.

## 10. AI Prompt Design

### Sinh script video

```text
You are a short-form video strategist.
Create a {duration_seconds}-second vertical video script in {language}.
Topic: {topic}
Style: {style}
Audience: TikTok/Reels/Shorts viewers.
Return JSON with: title, hook, full_script, scenes_suggestion, hashtags.
Keep narration concise, engaging, and safe for general audiences.
```

### Chia scene

```text
Split this script into {target_scene_count} scenes for a 9:16 short video.
Each scene must include: position, narration, visual_description, duration_seconds.
Total duration must be close to {duration_seconds}.
Return valid JSON only.
Script: {script}
```

### Sinh image prompt

```text
Create a cinematic image generation prompt for a vertical 9:16 video scene.
Scene narration: {narration}
Visual description: {visual_description}
Style: {style}
Avoid text, logos, distorted hands, and copyrighted characters.
Return: prompt, negative_prompt, camera_style, lighting, mood.
```

### Sinh caption/subtitle

```text
Create subtitle lines for this narration.
Language: {language}
Max characters per line: 42
Keep line breaks natural for mobile video.
Return SRT-compatible segments using provided timings.
Narration and timings: {scene_timings}
```

### Sinh TikTok metadata

```text
Generate a TikTok/Reels/Shorts title, description, and 8-12 hashtags.
Topic: {topic}
Script: {script}
Style: {style}
Language: {language}
Avoid misleading claims and spam hashtags.
Return JSON only.
```

## 11. Testing Plan

- Unit test: `CreditService`, `StoragePathService`, prompt builders, enum transitions.
- Feature test: auth, create project, owner policy, start pipeline.
- Queue test: dispatch chain, job idempotency, failed job status update.
- API test: create/status/result/retry/delete.
- FFmpeg render test: use small fixture images/audio, assert MP4 exists and non-empty.
- AI service mock test: provider success, timeout, rate limit, invalid JSON.
- Storage test: local disk paths, cleanup temp, output URL generation.
- Admin test: admin can view/retry; normal user cannot.

## 12. Deployment Plan

- Server: PHP 8.5, Composer, Node, Redis, MySQL/PostgreSQL, FFmpeg, Supervisor.
- Install FFmpeg: package manager or static binary; verify `ffmpeg -version`.
- Queue worker: Supervisor process for `php artisan queue:work redis --queue=video,default --tries=3 --timeout=1200`.
- Scheduler: cron `* * * * * php artisan schedule:run`.
- Storage: local disk for MVP; S3 env ready.
- Env: AI keys, TTS keys, image provider keys, Redis, DB, queue, storage, mail.
- Monitoring/logging: Laravel logs, failed jobs table, pipeline logs, provider request logs, disk usage alert.

## 13. Roadmap Phát Triển

- Phase 1 MVP: auth, project CRUD, queue pipeline, script/scene/image/voice/subtitle/render, local storage, basic admin, mock + one real AI provider.
- Phase 2 Template system: template library, style presets, music presets, scene layout settings.
- Phase 3 Credit/payment: credit package, Stripe/payment gateway, invoice, usage/cost dashboard.
- Phase 4 AI video nâng cao: generated video clips, lip-sync, brand kit, multi-language dub, provider routing.
- Phase 5 Auto publish: TikTok/Reels/Shorts OAuth, scheduling, caption optimization, analytics import.

## 14. Bảng Task Triển Khai

| Epic | Task | Mô tả | Priority | Estimated effort | Dependencies | Acceptance criteria | Suggested Laravel files/classes |
|---|---|---|---|---:|---|---|---|
| Foundation | Bootstrap Laravel app directory | Tạo `video-generator-app/` và bootstrap Laravel 13 + PHP 8.5 | P0 | 1d | None | App chạy, `.env.example`, test mặc định pass | `video-generator-app/composer.json`, `bootstrap/app.php` |
| Foundation | Configure Redis queue | Cấu hình Redis queue, failed jobs, queue names | P0 | 0.5d | Bootstrap | `queue:work` chạy được, failed jobs lưu được | `config/queue.php`, `.env.example` |
| Foundation | Configure storage | Local disk path convention và S3-ready config | P0 | 0.5d | Bootstrap | Store/read/delete asset thành công | `config/filesystems.php`, `StoragePathService` |
| Auth | User authentication | Register/login/logout/protected routes | P0 | 1d | Bootstrap | Auth feature tests pass | `Auth/*Controller`, `User` |
| Auth | Admin authorization | Thêm `is_admin`, gate/policy admin | P0 | 0.5d | Auth | Admin-only route bị chặn với user thường | `AuthServiceProvider`/`AppServiceProvider`, `User` |
| Credits | Basic credit ledger | Reserve/charge/refund credit transaction | P0 | 1d | Auth | Không tạo project khi thiếu credit, refund khi fail | `CreditService`, `CreditTransaction` |
| Video Project | Project migrations/models | Tạo models, migrations, enums chính | P0 | 1.5d | Foundation | DB migrate pass, relations test pass | `VideoProject`, `VideoScene`, `VideoAsset`, Enums |
| Video Project | Project create form/API | Tạo project từ topic/style/language/voice/template/duration | P0 | 1d | Models, Auth, Credits | Validate đúng, owner scope đúng | `StoreVideoProjectRequest`, `VideoProjectController` |
| Dashboard | User dashboard | Hiển thị project gần đây, status, credit | P1 | 1d | Project CRUD | User chỉ thấy project của mình | `DashboardController`, Blade/Vue view |
| Templates | Seed MVP templates | Tạo template cơ bản cho video dọc | P1 | 0.5d | Models | Có template active để chọn | `VideoTemplateSeeder` |
| Voices | Seed MVP voices | Tạo danh sách giọng đọc provider/mock | P1 | 0.5d | Models | Form/API chọn được voice active | `VoiceSeeder` |
| AI Script | Provider contract | Tạo interface cho script generation | P0 | 0.5d | Project | Mock provider test pass | `ScriptGeneratorInterface`, DTOs |
| AI Script | OpenAI adapter | Gọi OpenAI sinh script + metadata | P0 | 1.5d | Provider contract | Log cost/request, handle timeout/rate limit | `OpenAiScriptGenerator`, `AiCostTracker` |
| Pipeline | GenerateScriptJob | Job sinh script và dispatch scene split | P0 | 1d | AI Script | Status/progress/log update đúng | `GenerateScriptJob` |
| Scenes | Scene planner | Chia scene từ script và lưu DB | P0 | 1d | Script | Tổng duration gần target, scenes có prompt | `ScenePlannerService`, `SplitScenesJob` |
| Images | Image provider contract | Interface + mock image generation | P0 | 0.5d | Scenes | Test mock lưu fake image path | `ImageGeneratorInterface` |
| Images | Generate image assets | Job generate ảnh từng scene, idempotent | P0 | 1.5d | Image provider | Assets lưu đúng, retry scene failed | `GenerateImageAssetsJob`, `ImageGenerationService` |
| Voice | TTS provider contract | Interface + mock TTS | P0 | 0.5d | Scenes | Test mock audio asset | `TextToSpeechInterface` |
| Voice | Generate voice | Job tạo audio narration | P0 | 1d | TTS provider | Audio asset lưu, duration metadata có | `GenerateVoiceJob`, `TextToSpeechService` |
| Subtitles | Subtitle generation | Tạo SRT/VTT từ scene timings | P0 | 1d | Scenes, Voice | SRT valid, sync gần duration | `SubtitleService`, `GenerateSubtitleJob` |
| Rendering | FFmpeg service | Build command, run process, capture stderr | P0 | 2d | Images, Voice, Subtitle | Fixture render tạo MP4 non-empty | `FfmpegRenderService`, `RenderManifest` |
| Rendering | RenderVideoJob | Render MP4 1080x1920 và thumbnail | P0 | 1.5d | FFmpeg service | Output asset và thumbnail tồn tại | `RenderVideoJob` |
| Finalize | Finalize pipeline | Charge credit, mark completed, notify user | P0 | 1d | Rendering, Credits | Không double charge, completed event fire | `FinalizeVideoJob`, Events |
| Pipeline | Orchestrator/retry | Start/retry pipeline từ failed step | P1 | 1d | Jobs | Retry không duplicate asset/charge | `VideoPipelineOrchestrator` |
| Frontend | Idea input page | Form nhập topic/style/language/voice/template/duration | P0 | 1d | Project create | UX tạo project thành công | Blade/Vue/React page |
| Frontend | Template selection | Grid template + preview | P1 | 1d | Templates | Chọn template ghi vào project | `VideoTemplateController`, views |
| Frontend | Script preview | Hiển thị script/scenes trước render nếu enabled | P2 | 1d | Script/Scenes | User approve hoặc regenerate | `ScriptPreviewController` |
| Frontend | Progress page | Poll status hoặc broadcast progress | P0 | 1d | Pipeline | Progress cập nhật từng step | `VideoProjectPipelineController`, JS |
| Frontend | Video preview page | Player, download, metadata copy | P0 | 1d | Finalize | Completed project xem/tải được | `VideoProjectPreviewController` |
| API | Project API | Create/list/show/start/status/result/retry/delete endpoints | P1 | 2d | Project/Pipeline | API tests pass, policy owner-only | `Api/VideoProjectController`, Resources |
| Admin | Admin project monitor | List/filter failed/running/completed projects | P1 | 1.5d | Project/Pipeline | Admin xem/retry được failed jobs | Filament Resources or Admin controllers |
| Admin | User/credit admin | Grant credit, view user usage | P1 | 1d | Credits | Transaction log đúng | `Admin/UserResource`, `CreditService` |
| Observability | Pipeline logs | Log step start/completed/failed with context | P0 | 1d | Pipeline | Admin/debug thấy logs theo project | `PipelineLog`, listeners |
| Observability | Provider request logs | Ghi token/cost/status/error mỗi AI call | P1 | 1d | AI providers | Cost dashboard có dữ liệu | `AiProviderRequest`, `AiCostTracker` |
| Error Handling | Custom exceptions | Chuẩn hóa lỗi AI/render/storage/credit | P0 | 0.5d | Services | User không thấy raw exception | `App\Exceptions\PipelineException` |
| Testing | Core test suite | Unit/Feature/Queue/API/FFmpeg/mock AI tests | P0 | 2d | Core modules | `php artisan test` pass | `tests/Feature`, `tests/Unit` |
| Deployment | Deployment docs/config | Server req, FFmpeg, queue worker, scheduler, env | P1 | 1d | MVP core | Docs đủ deploy staging | `docs/deployment.md`, `.env.example` |
