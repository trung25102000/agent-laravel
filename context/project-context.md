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
- Product positioning:
  - service-first platform cho web, code, app, SEO và hỗ trợ kỹ thuật
  - tập trung chuyển đổi lead tư vấn/báo giá cho cá nhân, shop nhỏ, sinh viên, khách cần sửa website và doanh nghiệp nhỏ
  - template, source code và demo project là trust asset và offer phụ trợ để giúp khách xem trước năng lực triển khai, không phải thông điệp duy nhất của toàn site
- Nhóm dịch vụ cốt lõi cần thể hiện nhất quán trên public pages:
  - SEO website
  - fix và chỉnh sửa giao diện website
  - tạo website và landing page
  - hỗ trợ đồ án sinh viên
  - nhận làm task lập trình nhỏ
- Domain chính:
  - homepage landing page chuyển đổi khách hàng
  - service catalog và service detail pages
  - pricing/reference packages
  - quote requests / consultation funnel
  - order requests
  - graduation project requests
  - contact messages
  - portfolio hoặc demo projects
  - blog SEO / website / lập trình
  - source code products
  - template/category
  - product attachments
  - FAQ / trust content
- Lớp UI public hiện có:
  - floating quick-contact icons cho Zalo/Facebook/Email ở góc phải dưới
  - footer nhấn mạnh branding, CTA và trust copy thay cho phần kết trang mờ nhạt trước đó
- Admin: auth + gate `access-admin`, dashboard hiện còn dùng namespace marketplace tại `/admin`; backlog mới sẽ dần tái định nghĩa UI/terminology theo service platform
- Trạng thái backlog:
  - chuỗi service-platform `049-062` đã hoàn tất với catalog dịch vụ, portfolio, feedback, pricing tham khảo, admin lead workflow, blog pillars, technical SEO và mobile polish
  - chuỗi `063-071` đã hoàn tất, đưa homepage/public pages lên hướng landing-page agency-grade với hero mới, storytelling, visual system, rotating media và CRO polish

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
