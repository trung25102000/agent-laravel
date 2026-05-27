# Task: Source Code And Demo Project Module

## Status
completed

## Priority
high

## Objective
Xây dựng module quản lý mẫu source code Laravel và demo project để bán cho sinh viên hoặc khách cần source có sẵn.

## Requirements
- Tạo model `SourceCodeProduct`.
- Tạo model `DemoProject` hoặc quan hệ demo cho template/source.
- Source code có title, slug, tech stack, Laravel version, database type, price, description, status.
- Demo project có demo URL, admin URL nếu cần, screenshot/gallery, tài khoản demo nếu được phép hiển thị.
- Public listing/detail source code.
- Admin CRUD source code và demo project.

## Files Expected
- `video-generator-app/app/Models/SourceCodeProduct.php`
- `video-generator-app/app/Models/DemoProject.php`
- `video-generator-app/database/migrations/*create_source_code_products_table.php`
- `video-generator-app/database/migrations/*create_demo_projects_table.php`
- `video-generator-app/app/Http/Controllers/Admin/SourceCodeProductController.php`
- `video-generator-app/app/Http/Controllers/Admin/DemoProjectController.php`
- `video-generator-app/app/Http/Controllers/SourceCodeProductController.php`
- `video-generator-app/resources/views/source-code/*`
- `video-generator-app/resources/views/admin/source-code-products/*`
- `video-generator-app/resources/views/admin/demo-projects/*`
- `video-generator-app/tests/Feature/SourceCodeProductTest.php`

## Implementation Notes
- Không public credential nhạy cảm.
- Demo account nếu có phải là tài khoản demo riêng.
- Dùng enum status active/inactive.

## Done When
- Admin quản lý source code và demo project.
- Public xem được source active.
- Demo URL hiển thị an toàn.

## Test Requirements
- Test admin CRUD source code.
- Test admin CRUD demo project.
- Test public listing/detail active.
- Test inactive không public.

## Suggested Git Commit Message
- `feat: add source code and demo project modules`
