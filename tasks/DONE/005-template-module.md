# Task: Template Module

## Status
completed

## Priority
high

## Objective
Xây dựng module quản lý mẫu website để admin đăng bán template, landing page, source code Laravel hoặc website theo ngành.

## Requirements
- Tạo model `WebsiteTemplate`.
- Migration có category, title, slug, summary, description, preview image, gallery, demo URL, price, sale price, tech stack, status active/inactive, featured.
- Admin CRUD template.
- Upload/nhập ảnh preview an toàn theo module media hiện có hoặc tạm dùng path/url validate.
- Demo URL validate dạng URL.
- Giá lưu bằng integer cents hoặc decimal rõ ràng.
- Public chỉ hiển thị template active.

## Files Expected
- `video-generator-app/app/Models/WebsiteTemplate.php`
- `video-generator-app/database/migrations/*create_website_templates_table.php`
- `video-generator-app/app/Http/Controllers/Admin/WebsiteTemplateController.php`
- `video-generator-app/app/Http/Requests/StoreWebsiteTemplateRequest.php`
- `video-generator-app/app/Http/Requests/UpdateWebsiteTemplateRequest.php`
- `video-generator-app/resources/views/admin/website-templates/*`
- `video-generator-app/database/factories/WebsiteTemplateFactory.php`
- `video-generator-app/tests/Feature/AdminWebsiteTemplateTest.php`
- `.agents/context/database-schema.md`

## Implementation Notes
- Dùng enum hoặc constants cho status nếu có nhiều trạng thái.
- Dùng casts cho gallery/config/json, price integer/decimal.
- Eager load category khi listing admin/public.
- Không expose inactive template qua public detail.

## Done When
- Admin quản lý template đầy đủ.
- Template có category, giá, demo URL, trạng thái active/inactive.
- Factory/test hoạt động.

## Test Requirements
- Test admin CRUD template.
- Test validation price/demo URL/status.
- Test inactive template không hiển thị public.
- Test non-admin không truy cập admin template.

## Suggested Git Commit Message
- `feat: add website template catalog management`
