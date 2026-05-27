# Task: Contact Module

## Status
completed

## Priority
high

## Objective
Xây dựng form liên hệ public và màn hình admin quản lý tin nhắn để khách hỏi mua, tư vấn hoặc yêu cầu báo giá nhanh.

## Requirements
- Tạo model `ContactMessage`.
- Public form nhận name, email, phone, subject, message.
- Validate dữ liệu và rate limit form.
- Lưu status: new, read, replied, archived.
- Admin xem danh sách, lọc status, xem chi tiết, cập nhật status.
- Có thể liên kết Customer nếu module customer đã có.

## Files Expected
- `video-generator-app/app/Models/ContactMessage.php`
- `video-generator-app/database/migrations/*create_contact_messages_table.php`
- `video-generator-app/app/Enums/ContactMessageStatusEnum.php`
- `video-generator-app/app/Http/Controllers/ContactController.php`
- `video-generator-app/app/Http/Controllers/Admin/ContactMessageController.php`
- `video-generator-app/app/Http/Requests/StoreContactMessageRequest.php`
- `video-generator-app/resources/views/contact.blade.php`
- `video-generator-app/resources/views/admin/contact-messages/*`
- `video-generator-app/tests/Feature/ContactMessageTest.php`

## Implementation Notes
- Không gửi mail trực tiếp trong controller, để event/listener cho task notification.
- Form public có CSRF.
- Không hiển thị nội dung message chưa escape.

## Done When
- Khách gửi contact thành công.
- Admin quản lý message được.
- Rate limit và validation hoạt động.

## Test Requirements
- Test submit contact success.
- Test validation fail.
- Test admin listing/detail/update status.
- Test non-admin forbidden.

## Suggested Git Commit Message
- `feat: add contact message module`
