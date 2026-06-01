# Database Schema

## SEO Web App (`seo-web-app/`)

- `users`: auth/admin, có `is_admin`
- `cache`, `jobs`: Laravel defaults
- `template_categories`: danh mục mẫu web
- `website_templates`: mẫu website/landing/catalog, demo URL, price, status
- `pricing_packages`: gói giá theo nhóm khách hàng và loại dịch vụ
- `service_offerings`: danh mục dịch vụ công nghệ service-first gồm SEO, fix UI, làm web/landing page, hỗ trợ đồ án và task lập trình
- `customers`: hồ sơ khách/lead được upsert theo email hoặc phone
- `order_requests`: yêu cầu mua template/dịch vụ, có `lead_source`, `priority`, `internal_note`
- `quote_requests`: form báo giá dịch vụ, có `preferred_contact_channel`, `budget_range`, `deadline`, `technology_stack`, `lead_source`, `priority`, `admin_note`
- `graduation_project_requests`: yêu cầu đồ án sinh viên, có `lead_source`, `priority`, `admin_note`
- `contact_messages`: tin nhắn liên hệ, có thể lưu `service_type`, `preferred_contact_channel`, `priority`, `admin_note` cho trường hợp chưa đủ scope để vào quote funnel
- `blog_posts`: bài SEO theo nhóm khách hàng, có `content_pillar`, `service_group`, meta fields và published status để phục vụ internal linking sang dịch vụ
- `testimonials`: feedback khách hàng có audience, service type, rating, trust tag, status, sort order
- `source_code_products`: sản phẩm source Laravel
- `demo_projects`: portfolio/case study public cho source, template hoặc dự án dịch vụ; có slug, project_type, client_problem, implemented_solution, tech_stack, role_summary, outcome_summary, preview_image_path, status
- `product_attachments`: polymorphic file attachment
- `faq_items`: FAQ theo audience

Relationships chính:

- `template_categories` 1-n `website_templates`
- `service_offerings`: độc lập ở phase hiện tại, dùng cho public service catalog và admin publish workflow
- `website_templates` 1-n `order_requests`, 1-n `demo_projects`, morph-many `product_attachments`
- `pricing_packages` 1-n `order_requests`
- `customers` 1-n `order_requests`, `quote_requests`, `graduation_project_requests`
- `source_code_products` 1-n `demo_projects`, morph-many `product_attachments`

## Video Generator App (`video-generator-app/`)

- `users`: auth/admin, có `is_admin`
- `cache`, `jobs`, `notifications`: Laravel defaults + notification database
- `video_projects`: thuộc user, chứa input, status, progress, script/audio/subtitle/render metadata
- `video_scenes`: thuộc video project, sort_order, text, duration, visual prompt, status
- `video_assets`: thuộc project hoặc scene, type/disk/path/source/metadata

Relationships chính:

- `users` 1-n `video_projects`
- `video_projects` 1-n `video_scenes`
- `video_projects` 1-n `video_assets`
- `video_scenes` 1-n `video_assets`
- `users` 1-n `notifications`

## Notes

- Hai app không dùng chung database local.
- `seo-web-app` dùng `database/seo_web.sqlite` theo `.env.example`.
- `video-generator-app` giữ `database/database.sqlite` mặc định.
