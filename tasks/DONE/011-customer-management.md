# Task: Customer Management

## Status
completed

## Priority
medium

## Objective
Lưu và quản lý thông tin khách hàng, tránh trùng email/số điện thoại, cho admin xem lịch sử đơn hàng và liên hệ.

## Requirements
- Tạo model `Customer`.
- Field: name, email, phone, company, source, notes, last_contacted_at.
- Liên kết order/contact với customer.
- Khi khách gửi order/contact, tạo hoặc cập nhật customer theo email/phone.
- Admin xem danh sách khách, chi tiết, lịch sử đơn.
- Tránh duplicate email/số điện thoại nếu có thể.

## Files Expected
- `video-generator-app/app/Models/Customer.php`
- `video-generator-app/database/migrations/*create_customers_table.php`
- `video-generator-app/database/migrations/*add_customer_id_to_order_requests_table.php`
- `video-generator-app/app/Services/CustomerUpsertService.php`
- `video-generator-app/app/Http/Controllers/Admin/CustomerController.php`
- `video-generator-app/resources/views/admin/customers/*`
- `video-generator-app/tests/Feature/CustomerManagementTest.php`
- `.agents/context/database-schema.md`

## Implementation Notes
- Dùng transaction khi tạo order/contact và upsert customer.
- Email nullable nếu khách chỉ nhập phone, nhưng cần index hợp lý.
- Không expose customer listing public.

## Done When
- Customer được tạo/cập nhật khi có order/contact.
- Admin xem lịch sử đơn của customer.
- Không tạo duplicate rõ ràng với cùng email.

## Test Requirements
- Test upsert customer theo email.
- Test upsert theo phone khi email trống.
- Test admin customer listing/detail.
- Test non-admin bị chặn.

## Suggested Git Commit Message
- `feat: add customer management`
