# Task: Audit hiện trạng và chốt kiến trúc tách source

## Status
completed

## Priority
high

## Objective
Phân tích monolith hiện tại đang chứa cả `video-generator` và `seo-web`, sau đó chốt kiến trúc thư mục đích để hai dự án chạy độc lập, dễ deploy riêng và không còn phụ thuộc code/domain lẫn nhau.

## Requirements
- Đọc toàn bộ .agents/context/.agents/rules/.agents/memory hiện tại trước khi tách.
- Audit các module đang nằm chung trong `video-generator-app`.
- Phân loại code thành 2 nhóm:
  - `video-generator`: auth user, video projects, AI script, scene, voice, subtitle, FFmpeg render, preview/download, API video.
  - `seo-web`: marketplace bán template/dịch vụ/source Laravel, pricing, order, quote, graduation request, contact, blog SEO, admin marketplace.
- Chốt cấu trúc thư mục:
  - `/video-generator-app`: Laravel app chỉ còn module tạo video AI.
  - `/seo-web-app`: Laravel app chỉ còn website bán template/dịch vụ/source Laravel.
  - Root repo giữ `.agents/AGENTS.md`, `/.agents/rules`, `/.agents/context`, `/.agents/memory`, `/tasks`, `/.agents/agents`, `/.codex/prompts`.
- Chốt cách xử lý phần dùng chung:
  - Ưu tiên copy độc lập cho auth/admin đơn giản ở mỗi app.
  - Không tạo shared package nếu chưa có nhu cầu thật.
- Lập map file cần move/copy/xóa cho từng app.
- Ghi quyết định kiến trúc vào `/.agents/context/decisions.md`.

## Files Expected
- `/.agents/context/decisions.md`
- `/.agents/context/project-context.md`
- `/.agents/context/routes-map.md`
- `/.agents/context/database-schema.md`
- Có thể tạo `/.agents/context/source-separation-plan.md`

## Implementation Notes
- Không move code ở task này, chỉ audit và document.
- Dùng `rg`, `php artisan route:list`, `php artisan test --list-tests` để xác định boundary.
- Ghi rõ các namespace/controller/model/view/migration thuộc từng domain.
- Cần chỉ ra rủi ro khi tách migrations vì hiện database schema đang ở một Laravel app.

## Done When
- Có tài liệu phân tách rõ module nào thuộc app nào.
- Có thư mục đích và naming convention được chốt.
- Có danh sách file/classes cần chuyển sang `seo-web-app`.
- Có danh sách file/classes cần giữ lại ở `video-generator-app`.
- Không có code runtime bị thay đổi ngoài tài liệu.

## Test Requirements
- Không bắt buộc chạy full suite vì chưa đổi code runtime.
- Chạy `php artisan route:list` trong `video-generator-app` để lấy baseline route hiện tại.

## Suggested Git Commit Message
- docs: plan source separation for video and seo web apps
