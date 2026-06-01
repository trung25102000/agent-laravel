# Task: Admin Dashboard

## Status
completed

## Priority
high

## Objective
Xây dựng dashboard admin tổng quan để theo dõi số lượng template, đơn hàng, contact, khách hàng và các đơn mới gần đây.

## Requirements
- Route admin dashboard.
- Hiển thị số template active/inactive.
- Hiển thị số order theo status.
- Hiển thị số contact new/unread.
- Hiển thị số lead/yêu cầu báo giá mới.
- Hiển thị số yêu cầu đồ án mới.
- Hiển thị khách hàng mới hoặc tổng khách.
- Danh sách đơn hàng mới gần đây.
- Danh sách lead/yêu cầu đồ án mới gần đây.
- Link nhanh tới CRUD template, order, contact, blog.
- Admin only.

## Files Expected
- `video-generator-app/app/Http/Controllers/Admin/DashboardController.php`
- `video-generator-app/resources/views/admin/dashboard.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/AdminDashboardTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Query chỉ lấy số liệu cần thiết.
- Tránh N+1 khi hiển thị recent orders.
- Nếu module nào chưa có, hiển thị 0 hoặc guard bằng class_exists hợp lý.

## Done When
- Admin dashboard có số liệu chính.
- Admin có link điều hướng quản trị.
- Non-admin/guest bị chặn.

## Test Requirements
- Test admin xem dashboard.
- Test stats đúng với dữ liệu mẫu.
- Test guest redirect, non-admin forbidden.

## Suggested Git Commit Message
- `feat: add admin dashboard analytics`
