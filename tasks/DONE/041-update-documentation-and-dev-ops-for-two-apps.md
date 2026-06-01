# Task: Cập nhật documentation và devops cho hai source riêng

## Status
completed

## Priority
medium

## Objective
Viết tài liệu setup, chạy local, deploy, env, queue/storage cho từng dự án sau khi tách source.

## Requirements
- Root README mô tả repo có 2 Laravel app:
  - `/seo-web-app`
  - `/video-generator-app`
- README từng app có:
  - yêu cầu PHP/Composer/Node.
  - setup `.env`.
  - migrate/seed.
  - chạy server local.
  - chạy tests.
  - build assets.
  - deploy notes.
- `seo-web-app` docs:
  - SMTP/contact config.
  - storage upload template/source/report/database.
  - admin account seed.
  - public routes.
- `video-generator-app` docs:
  - queue worker.
  - FFmpeg/FFprobe.
  - video storage/private stream.
  - AI/TTS/render providers.
- Cập nhật `/.agents/context/project-context.md`, `/.agents/context/routes-map.md`, `/.agents/context/database-schema.md`.

## Files Expected
- `/README.md`
- `/seo-web-app/README.md`
- `/video-generator-app/README.md`
- `/.agents/context/project-context.md`
- `/.agents/context/routes-map.md`
- `/.agents/context/database-schema.md`
- `/.agents/context/decisions.md`

## Implementation Notes
- Tài liệu cần viết bằng tiếng Việt hoặc song ngữ nhất quán.
- Nêu rõ port local đề xuất:
  - SEO-web: `http://127.0.0.1:8010`
  - Video generator: `http://127.0.0.1:8020`
- Không ghi secrets thật vào docs.

## Done When
- Developer mới nhìn README có thể chạy từng app độc lập.
- Context/.agents/memory phản ánh kiến trúc mới.
- Không còn mô tả gây hiểu nhầm rằng marketplace và video nằm chung một app.

## Test Requirements
- Chạy lại commands trong README tối thiểu một lần cho cả hai app.

## Suggested Git Commit Message
- docs: document standalone seo web and video generator apps
