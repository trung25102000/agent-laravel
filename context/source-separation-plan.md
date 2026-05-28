# Source Separation Plan

## Mục Tiêu

Tách monolith hiện tại thành hai Laravel app độc lập:

- `seo-web-app/`: website bán template, landing page, source Laravel, demo project và dịch vụ làm web.
- `video-generator-app/`: nền tảng tạo video AI short-form, render/preview/download MP4.

Root repo tiếp tục giữ vai trò control plane cho agent: `AGENTS.md`, `rules/`, `context/`, `memory/`, `tasks/`, `agents/`, `prompts/`.

## Boundary Theo Domain

### SEO Web App

Giữ/copy sang `seo-web-app`:

- Controllers:
  - `App\Http\Controllers\MarketplaceController`
  - `App\Http\Controllers\Admin\MarketplaceAdminController`
  - Auth controllers tối giản để admin đăng nhập.
- Requests:
  - `StoreOrderRequestRequest`
  - `StoreQuoteRequestRequest`
  - `StoreGraduationProjectRequestRequest`
  - `StoreContactMessageRequest`
  - Auth login/register requests.
- Models:
  - `TemplateCategory`
  - `WebsiteTemplate`
  - `PricingPackage`
  - `Customer`
  - `OrderRequest`
  - `QuoteRequest`
  - `GraduationProjectRequest`
  - `ContactMessage`
  - `BlogPost`
  - `SourceCodeProduct`
  - `DemoProject`
  - `ProductAttachment`
  - `FaqItem`
  - `User`
- Services:
  - `CustomerUpsertService`
- Config:
  - `contact.php`
  - auth/session/cache/database/mail/filesystems app config chuẩn Laravel.
- Views:
  - `marketplace/**`
  - `admin/marketplace/**`
  - `components/contact-cta.blade.php`
  - `components/faq-list.blade.php`
  - `components/template-card.blade.php`
  - `components/admin/marketplace/**`
  - layout/auth views được branding SEO-web.
- Database:
  - users/cache/jobs mặc định
  - `users.is_admin`
  - marketplace tables trong `2026_05_28_000001_create_marketplace_tables.php`
- Tests:
  - marketplace public/forms/admin/branding tests
  - auth tests cần thiết cho admin access.

### Video Generator App

Giữ lại trong `video-generator-app`:

- Controllers:
  - `DashboardController`
  - `VideoProjectController`
  - `VideoProjectStatusController`
  - `VideoProjectPreviewController`
  - `Api\VideoProjectController`
  - `Admin\AdminDashboardController`
  - Auth controllers.
- Requests:
  - `StoreVideoProjectRequest`
  - `Api\StoreVideoProjectRequest`
  - Auth login/register requests.
- Models:
  - `User`
  - `VideoProject`
  - `VideoScene`
  - `VideoAsset`
- Enums/DTOs/Jobs/Events/Listeners/Notifications/Policies video.
- Services:
  - script, scene, media asset, voice-over, subtitle, render, demo xianxia services.
- Config:
  - `video_pipeline.php`
- Views:
  - `welcome.blade.php`
  - `dashboard.blade.php`
  - `video-projects/**`
  - `admin/dashboard.blade.php`
  - layout/auth views được branding AI Video Generator.
- Database:
  - users/cache/jobs/notifications
  - video project/scenes/assets/audio/subtitle/render metadata migrations.
- Tests:
  - video project, API, pipeline, render, preview/download, security tests.

## Quyết Định Kỹ Thuật

- Tạm thời copy auth/admin tối giản vào cả hai app thay vì tạo shared package. Hai app cần deploy độc lập, nên duplication nhỏ dễ vận hành hơn abstraction sớm.
- Mỗi app có `.env.example`, SQLite local DB, Vite build, README và test suite riêng.
- Không dùng chung database local. `seo-web-app` dùng `database/seo_web.sqlite`; `video-generator-app` dùng `database/database.sqlite` theo mặc định cũ.
- Không giữ marketplace route/class trong video app sau khi extraction pass.
- Không giữ video route/class trong SEO app sau khi extraction pass.

## Rủi Ro Và Cách Xử Lý

- Migrations marketplace đã từng nằm trong video app. Vì đây là local/MVP chưa có production migration contract, video app sẽ xóa migration marketplace khỏi code; DB local cũ có thể còn bảng dư nhưng test fresh DB không tạo nữa.
- Seeder `DatabaseSeeder` cũ tạo `test@example.com` bằng factory có thể bị duplicate khi seed nhiều lần. Seeder mới dùng `updateOrCreate`.
- Nếu cần migrate dữ liệu thật sau này, tạo script export/import từ DB cũ sang DB riêng của `seo-web-app`.
