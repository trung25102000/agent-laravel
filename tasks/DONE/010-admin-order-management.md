# Task: Admin Order Management

## Status
completed

## Priority
high

## Objective
Xây dựng màn hình admin quản lý đơn hàng, lọc trạng thái, xem chi tiết, cập nhật trạng thái và ghi chú nội bộ.

## Requirements
- Admin xem danh sách order request.
- Filter theo status, ngày tạo, template, package nếu có.
- Xem chi tiết thông tin khách và yêu cầu.
- Cập nhật trạng thái đơn hàng.
- Ghi chú nội bộ không hiển thị public.
- Log hoặc lưu lịch sử cập nhật trạng thái nếu phù hợp.
- Admin only.

## Files Expected
- `video-generator-app/app/Http/Controllers/Admin/OrderRequestController.php`
- `video-generator-app/app/Http/Requests/Admin/UpdateOrderStatusRequest.php`
- `video-generator-app/resources/views/admin/orders/index.blade.php`
- `video-generator-app/resources/views/admin/orders/show.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/AdminOrderManagementTest.php`
- `context/routes-map.md`

## Implementation Notes
- Dùng enum status từ order module.
- Không cho status không hợp lệ.
- Query listing có pagination.
- Dùng policy/gate admin.

## Done When
- Admin xem, lọc, cập nhật đơn hàng.
- Non-admin bị chặn.
- Internal note lưu đúng và không expose public.

## Test Requirements
- Test admin listing/filter.
- Test admin update status/note.
- Test validation status fail.
- Test guest/non-admin forbidden.

## Suggested Git Commit Message
- `feat: add admin order management`
