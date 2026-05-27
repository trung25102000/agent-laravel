# Task: Order Request Module

## Status
completed

## Priority
high

## Objective
Cho phép khách gửi yêu cầu mua template, yêu cầu báo giá làm web, hoặc yêu cầu chỉnh sửa/làm web theo nhóm nhu cầu shop nhỏ/cá nhân online/sinh viên.

## Requirements
- Tạo model `OrderRequest`.
- Form public nhận: tên, email, phone, template, gói giá, ngân sách, deadline, yêu cầu chỉnh sửa, ghi chú.
- Form có trường nhóm khách hàng: shop nhỏ, cá nhân kinh doanh online, sinh viên.
- Form có trường loại nhu cầu: mua template, làm landing page, làm website shop, làm đồ án/source Laravel.
- CTA nhanh từ Zalo/Facebook/Email vẫn lưu lead nếu khách gửi form.
- Lưu trạng thái đơn hàng: new, contacted, quoted, in_progress, completed, cancelled.
- Validate dữ liệu đầu vào.
- Rate limit form public.
- Tránh expose thông tin khách cho người khác.
- Sau submit hiển thị trang cảm ơn hoặc flash success.

## Files Expected
- `video-generator-app/app/Models/OrderRequest.php`
- `video-generator-app/database/migrations/*create_order_requests_table.php`
- `video-generator-app/app/Enums/OrderStatusEnum.php`
- `video-generator-app/app/Http/Controllers/OrderRequestController.php`
- `video-generator-app/app/Http/Requests/StoreOrderRequestRequest.php`
- `video-generator-app/resources/views/orders/create.blade.php`
- `video-generator-app/resources/views/orders/thank-you.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/OrderRequestTest.php`
- `context/database-schema.md`

## Implementation Notes
- Controller chỉ nhận request và gọi service nếu cần.
- Có thể tạo/cập nhật Customer dựa trên email/phone trong task customer hoặc service riêng.
- Dùng enum cho status.
- Không gửi mail trong controller nếu module mail đã có, dùng event/listener ở task 016.

## Done When
- Khách gửi yêu cầu mua thành công.
- Order được lưu với status `new`.
- Validation và rate limit hoạt động.
- Admin chưa cần quản lý ở task này.

## Test Requirements
- Test submit order thành công.
- Test submit yêu cầu báo giá theo từng nhóm khách hàng.
- Test validation fail.
- Test liên kết template/pricing package nếu chọn.
- Test rate limit nếu đã cấu hình.

## Suggested Git Commit Message
- `feat: add public order request flow`
