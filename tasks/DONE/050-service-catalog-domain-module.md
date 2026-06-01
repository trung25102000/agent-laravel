# Task: Service Catalog Domain Module

## Status
completed

## Priority
high

## Objective
Tạo module domain cho danh mục dịch vụ để website có thể quản lý và hiển thị rõ các dịch vụ web, code, app, SEO và hỗ trợ kỹ thuật thay vì chỉ dựa vào copy tĩnh.

## Requirements
- Tạo model/module dịch vụ, ví dụ `ServiceOffering`.
- Mỗi dịch vụ nên có:
  - tên
  - slug
  - nhóm dịch vụ
  - mô tả ngắn
  - mô tả chi tiết
  - đối tượng phù hợp
  - lợi ích nổi bật
  - quy trình thực hiện
  - gói giá tham khảo hoặc pricing note
  - trạng thái publish
  - sort order
- Seed sẵn các dịch vụ trọng tâm:
  - SEO website
  - fix giao diện website
  - thiết kế website/landing page
  - hỗ trợ đồ án sinh viên
  - task lập trình nhanh
- Admin có thể quản lý tối thiểu danh sách dịch vụ và trạng thái publish.

## Files Expected
- `seo-web-app/app/Models/ServiceOffering.php`
- `seo-web-app/database/migrations/*create_service_offerings_table.php`
- `seo-web-app/database/seeders/*ServiceOffering*Seeder.php`
- `seo-web-app/app/Http/Controllers/Admin/*`
- `seo-web-app/resources/views/admin/marketplace/services.blade.php`
- `seo-web-app/tests/Feature/*ServiceCatalog*Test.php`
- `.agents/context/database-schema.md`
- `.agents/context/routes-map.md`

## Implementation Notes
- Nếu cần enum cho `service_group` hoặc `status`, dùng enum riêng.
- Model phải có `fillable`, `casts` và thứ tự hiển thị rõ ràng.
- Không nhồi business logic vào controller admin.

## Done When
- Admin xem được và quản lý được danh mục dịch vụ cơ bản.
- Database có dữ liệu seed đủ để public pages dùng lại.
- Route và schema được tài liệu hóa.

## Test Requirements
- Test admin truy cập/list/create/update publish state.
- Test guest/non-admin không vào admin services.
- Chạy trong `seo-web-app`:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`

## Suggested Git Commit Message
- feat: add service catalog domain module
