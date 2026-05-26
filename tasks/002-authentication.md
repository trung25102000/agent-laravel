# Task: Authentication

## Status
pending

## Priority
high

## Objective
Triển khai xác thực người dùng cho web app để user có thể đăng ký, đăng nhập, đăng xuất, và truy cập các khu vực yêu cầu đăng nhập.

## Requirements
- Có flow register, login, logout
- Chuẩn hóa `User` model nếu cần thêm field cơ bản
- Gắn auth middleware cho khu vực user dashboard và video project
- Nếu dùng starter kit, phải giữ code sạch và phù hợp rules
- Có phân biệt user thường và admin theo cách mở rộng được về sau

## Files Expected
- `app/Models/User.php`
- `app/Http/Controllers/Auth/*` hoặc file tương đương theo stack đã chọn
- `routes/web.php`
- view/auth hoặc frontend auth files tương ứng
- migration liên quan nếu cần
- policy hoặc middleware liên quan nếu cần
- test xác thực
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên dùng giải pháp Laravel chuẩn như Breeze hoặc triển khai tối giản theo stack hiện có
- Chuẩn bị chỗ cho role/admin mà không làm phức tạp MVP
- Không hard-code redirect rối rắm, giữ flow auth đơn giản

## Done When
- User có thể register, login, logout
- Route cần bảo vệ đã có middleware
- Test auth pass
- Không vi phạm rules

## Test Requirements
- Feature test register thành công
- Feature test login thành công và thất bại
- Feature test route protected yêu cầu đăng nhập
