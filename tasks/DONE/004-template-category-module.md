# Task: Template Category Module

## Status
completed

## Priority
high

## Objective
Tạo module danh mục template để admin quản lý nhóm mẫu web và public có thể lọc/xem template theo ngành hoặc loại website.

## Requirements
- Tạo model `TemplateCategory`.
- Migration có `name`, `slug`, `description`, `sort_order`, `is_active`.
- Slug unique, index phục vụ public route.
- Admin CRUD category.
- Public hiển thị danh mục active.
- Không cho xóa category nếu còn template liên quan, hoặc xử lý detach/set null rõ ràng.

## Files Expected
- `video-generator-app/app/Models/TemplateCategory.php`
- `video-generator-app/database/migrations/*create_template_categories_table.php`
- `video-generator-app/app/Http/Controllers/Admin/TemplateCategoryController.php`
- `video-generator-app/app/Http/Requests/StoreTemplateCategoryRequest.php`
- `video-generator-app/app/Http/Requests/UpdateTemplateCategoryRequest.php`
- `video-generator-app/resources/views/admin/template-categories/*`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/AdminTemplateCategoryTest.php`
- `context/database-schema.md`
- `context/routes-map.md`

## Implementation Notes
- Dùng FormRequest cho create/update.
- Dùng route model binding theo slug cho public nếu cần.
- Admin routes phải qua `auth` và `access-admin`.
- Tự generate slug từ name nếu slug trống.

## Done When
- Admin tạo/sửa/xóa/xem danh mục được.
- Public chỉ thấy category active.
- Schema và route map được cập nhật.

## Test Requirements
- Test admin CRUD category.
- Test validation required/unique slug.
- Test guest/non-admin bị chặn khỏi admin CRUD.
- Test public không thấy inactive category.

## Suggested Git Commit Message
- `feat: add template category management`
