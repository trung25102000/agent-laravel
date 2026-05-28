# Project Context

## Loại Dự Án

Repo hiện có hai Laravel app độc lập:

- `seo-web-app/`: Web Template Studio, marketplace bán template website, landing page, source code Laravel, demo project và dịch vụ làm web theo yêu cầu.
- `video-generator-app/`: AI Video Generator, nền tảng tạo short-form video từ keyword/content brief qua script, scene, voice, subtitle và FFmpeg render.

Root repo là control plane cho agents: `AGENTS.md`, `rules/`, `context/`, `memory/`, `prompts/`, `tasks/`, `agents/`.

## Tech Stack Chung

- Laravel 13.x
- PHP local 8.4, tương thích PHP 8.5 khi runtime nâng cấp
- Blade + TailwindCSS + Vite
- PHPUnit feature/unit tests
- SQLite local mặc định; MySQL/PostgreSQL có thể cấu hình qua `.env`

## SEO Web App

- Directory: `seo-web-app/`
- Public brand: `Web Template Studio`
- Local URL đề xuất: `http://127.0.0.1:8010`
- Domain chính:
  - homepage landing page chuyển đổi khách hàng
  - dịch vụ làm website
  - template/category
  - pricing packages
  - order requests
  - quote requests
  - graduation project requests
  - contact messages
  - blog SEO
  - source code products
  - demo projects
  - product attachments
  - FAQ
- Admin: auth + gate `access-admin`, dashboard marketplace tại `/admin`

## Video Generator App

- Directory: `video-generator-app/`
- Public brand: `AI Video Generator`
- Local URL đề xuất: `http://127.0.0.1:8020`
- Domain chính:
  - auth user/admin
  - video project CRUD
  - script generation
  - scene generation
  - media assets
  - voice-over
  - subtitles
  - render job/provider
  - preview/stream/download
  - API video project status/result
- Queue/render:
  - Redis queue target `video`
  - Mock providers mặc định
  - FFmpeg provider bật bằng `VIDEO_RENDER_PROVIDER=ffmpeg`

## Coding Style

- Controller mỏng, validation bằng FormRequest, logic nghiệp vụ trong Service.
- Model khai báo guard/fillable strategy, casts và relationships rõ ràng.
- Mutating admin/user actions phải được auth/gate/policy bảo vệ.
- Mỗi app chạy validation riêng, không phụ thuộc migration/test của app còn lại.
