# Project Context

## Loại Dự Án

- Tên dự án: AI Video Generator MVP
- Loại ứng dụng: Web app Laravel có user area, admin area, và API nội bộ
- Domain nghiệp vụ: Tạo short-form video tự động từ input nội dung marketing hoặc social content
- Mục tiêu chính của hệ thống: Cho phép user nhập keyword, mô tả, tone, thời lượng, nền tảng và ngôn ngữ để hệ thống tự sinh script, scenes, voice-over, subtitle, asset list, render video, rồi preview/download kết quả

## Tech Stack

- Application directory: `video-generator-app/` là thư mục chứa source Laravel chính. Root repo giữ vai trò agent/control plane với `AGENTS.md`, `rules/`, `context/`, `memory/`, `prompts/`, và `tasks/`.
- Laravel version: Mục tiêu Laravel 13.x mới nhất, dùng constraint `laravel/framework:^13.0` cho project mới
- PHP version: Mục tiêu PHP 8.5 mới nhất, dùng constraint `php:^8.5`; Laravel 13 hỗ trợ PHP 8.3 - 8.5 nên chỉ hạ xuống 8.4/8.3 khi package hoặc môi trường bắt buộc và phải ghi rõ lý do vào `context/decisions.md`
- Database: Ưu tiên MySQL hoặc PostgreSQL, local/dev có thể bắt đầu với SQLite nếu cần để bootstrap
- Cache: file hoặc database cho MVP, có thể nâng cấp Redis sau
- Queue: database queue cho local/MVP, có thể nâng cấp Redis/SQS sau
- Session: database hoặc file tùy stack bootstrap cuối cùng
- Frontend stack: Blade + Vite cho MVP web UI; có thể mở rộng sang Livewire hoặc Inertia bằng starter kit chính thức của Laravel nếu task yêu cầu
- Auth / Permission package: Laravel auth chuẩn hoặc starter kit chính thức tương thích Laravel 13; role admin tối giản bằng policy/gate hoặc cờ `is_admin`
- Test stack: Pest hoặc PHPUnit theo mặc định framework/starter kit, ưu tiên Feature test + Unit test

## Coding Style

- Convention đặt tên: Theo Laravel convention, class PascalCase, table snake_case số nhiều, enum kết thúc bằng `Enum`
- Kiến trúc đang dùng: Service/Action oriented architecture, controller mỏng, FormRequest validation, API Resource cho API
- Pattern hiện có trong codebase: Hiện repo mới chỉ có autonomous agent framework, chưa có source Laravel để áp pattern vào code ứng dụng
- Quy ước response: Web dùng view/redirect chuẩn Laravel, API dùng JSON nhất quán qua Resource và status code đúng
- Quy ước xử lý exception: Không lộ raw exception ra client, dùng custom exception cho business rule quan trọng và log an toàn
- Modern PHP: Ưu tiên strict types, typed properties, return types, constructor property promotion, readonly class/property, enum, attributes, `match`, null-safe operator, và dependency injection rõ ràng khi phù hợp

## Module Chính

- Module 1: Authentication và phân quyền user/admin
- Module 2: Video project management và input collection
- Module 3: Content generation pipeline gồm script, scene, voice-over, subtitle, asset selection
- Module 4: Render pipeline, preview/download, notification, admin monitoring

## Ghi Chú Thêm

- Ràng buộc nghiệp vụ quan trọng: MVP ưu tiên provider interface + mock provider cho AI/TTS; render có mock provider mặc định và FFmpeg provider thật khi cấu hình `VIDEO_RENDER_PROVIDER=ffmpeg`
- Ràng buộc bảo mật: Owner-only access cho video project và file output; mọi mutate action phải authorize; không lộ file path nội bộ hoặc secret
- Ràng buộc hiệu năng: Các bước generate và render phải tách ra queue/job, tránh xử lý nặng trong request lifecycle
- Tích hợp ngoài: AI script provider, TTS provider, media source provider, FFmpeg hoặc render engine; giai đoạn đầu dùng mock implementation cho AI/TTS/media và có fallback FFmpeg local cho video thật

## Trạng Thái Repo Hiện Tại

- Repo root chứa bộ AGENTS/rules/tasks/context phục vụ workflow tự động.
- Source Laravel 13 đã được bootstrap trong `video-generator-app/`.
- `video-generator-app/` đã có `composer.json`, cấu trúc Laravel skeleton hiện đại, config pipeline video, storage directories nền tảng, và smoke test foundation.
- Môi trường local hiện chạy PHP 8.4.7; Composer constraint tạm dùng `php:^8.4` để validate được trên máy này và vẫn tương thích PHP 8.5 khi runtime được nâng cấp.
- Render thật yêu cầu `ffmpeg` và `ffprobe`; nếu thiếu binary, FFmpeg provider fail sớm với lỗi rõ ràng và test integration sẽ skip có điều kiện.
