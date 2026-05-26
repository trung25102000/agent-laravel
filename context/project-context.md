# Project Context

## Loại Dự Án

- Tên dự án: AI Video Generator MVP
- Loại ứng dụng: Web app Laravel có user area, admin area, và API nội bộ
- Domain nghiệp vụ: Tạo short-form video tự động từ input nội dung marketing hoặc social content
- Mục tiêu chính của hệ thống: Cho phép user nhập keyword, mô tả, tone, thời lượng, nền tảng và ngôn ngữ để hệ thống tự sinh script, scenes, voice-over, subtitle, asset list, render video, rồi preview/download kết quả

## Tech Stack

- Laravel version: Mục tiêu Laravel 12, chấp nhận Laravel 11 nếu môi trường/package yêu cầu
- PHP version: 8.3+
- Database: Ưu tiên MySQL hoặc PostgreSQL, local/dev có thể bắt đầu với SQLite nếu cần để bootstrap
- Cache: file hoặc database cho MVP, có thể nâng cấp Redis sau
- Queue: database queue cho local/MVP, có thể nâng cấp Redis/SQS sau
- Session: database hoặc file tùy stack bootstrap cuối cùng
- Frontend stack: Blade cho MVP web UI, có thể mở rộng sang Livewire/Inertia sau nếu cần
- Auth / Permission package: Laravel auth chuẩn, role admin tối giản bằng policy/gate hoặc cờ `is_admin`
- Test stack: PHPUnit/Pest theo mặc định framework, ưu tiên Feature test + Unit test

## Coding Style

- Convention đặt tên: Theo Laravel convention, class PascalCase, table snake_case số nhiều, enum kết thúc bằng `Enum`
- Kiến trúc đang dùng: Service/Action oriented architecture, controller mỏng, FormRequest validation, API Resource cho API
- Pattern hiện có trong codebase: Hiện repo mới chỉ có autonomous agent framework, chưa có source Laravel để áp pattern vào code ứng dụng
- Quy ước response: Web dùng view/redirect chuẩn Laravel, API dùng JSON nhất quán qua Resource và status code đúng
- Quy ước xử lý exception: Không lộ raw exception ra client, dùng custom exception cho business rule quan trọng và log an toàn

## Module Chính

- Module 1: Authentication và phân quyền user/admin
- Module 2: Video project management và input collection
- Module 3: Content generation pipeline gồm script, scene, voice-over, subtitle, asset selection
- Module 4: Render pipeline, preview/download, notification, admin monitoring

## Ghi Chú Thêm

- Ràng buộc nghiệp vụ quan trọng: MVP ưu tiên provider interface + mock provider cho AI, TTS, render; chưa khóa vào vendor thật
- Ràng buộc bảo mật: Owner-only access cho video project và file output; mọi mutate action phải authorize; không lộ file path nội bộ hoặc secret
- Ràng buộc hiệu năng: Các bước generate và render phải tách ra queue/job, tránh xử lý nặng trong request lifecycle
- Tích hợp ngoài: AI script provider, TTS provider, media source provider, FFmpeg hoặc render engine; giai đoạn đầu dùng mock implementation

## Trạng Thái Repo Hiện Tại

- Repo hiện mới chứa bộ AGENTS/rules/tasks/context phục vụ workflow tự động.
- Chưa có source code Laravel, `composer.json`, cấu trúc `app/`, `routes/`, `config/`, hoặc test suite ứng dụng.
- Task kỹ thuật tiếp theo cần khởi tạo hoặc đưa source Laravel vào repo trước khi triển khai tính năng sản phẩm.
