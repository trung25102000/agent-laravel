# Task: Notification Mail

## Status
completed

## Priority
medium

## Objective
Thiết lập email/notification khi có order hoặc contact mới, gồm mail cho admin và mail xác nhận cho khách, fallback log mail khi chưa cấu hình SMTP.

## Requirements
- Gửi mail admin khi có order mới.
- Gửi mail xác nhận khách khi gửi order/contact.
- Gửi mail admin khi có contact mới.
- Không block request nếu mail fail, ưu tiên queue nếu có.
- Mail cấu hình qua `.env`.
- Fallback `MAIL_MAILER=log` cho local.
- Nội dung mail rõ ràng, không lộ internal note.

## Files Expected
- `video-generator-app/app/Events/OrderRequestCreated.php`
- `video-generator-app/app/Events/ContactMessageCreated.php`
- `video-generator-app/app/Listeners/*`
- `video-generator-app/app/Mail/*`
- `video-generator-app/resources/views/emails/*`
- `video-generator-app/config/mail.php`
- `video-generator-app/.env.example`
- `video-generator-app/tests/Feature/NotificationMailTest.php`

## Implementation Notes
- Dùng Event/Listener/Mailable, không gửi trực tiếp trong controller.
- Dùng queue nếu queue đã sẵn sàng, hoặc sync trong test.
- Không log dữ liệu nhạy cảm quá mức.

## Done When
- Order/contact mới dispatch event.
- Mail admin và mail khách được queue/gửi/log.
- `.env.example` có mail config.

## Test Requirements
- Test `Mail::fake()` cho order.
- Test `Mail::fake()` cho contact.
- Test mail không chứa internal note.

## Suggested Git Commit Message
- `feat: add order and contact notifications`
