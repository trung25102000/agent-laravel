# Task: Feedback And Social Proof Module

## Status
completed

## Priority
medium

## Objective
Thêm khu vực feedback khách hàng và social proof để tăng độ tin cậy cho homepage và các trang dịch vụ.

## Requirements
- Tạo module testimonial/feedback hoặc cấu hình content block quản lý được.
- Mỗi feedback nên có:
  - tên người gửi hoặc nhãn ẩn danh hợp lý
  - nhóm khách hàng
  - loại dịch vụ đã dùng
  - nội dung phản hồi
  - rating hoặc trust tag nếu phù hợp
  - trạng thái publish
  - sort order
- Hiển thị feedback ở homepage, trang dịch vụ và/hoặc portfolio.
- Có trust badges/proof copy nhất quán với các cam kết như:
  - xem demo trước
  - bàn giao source/tài liệu
  - hỗ trợ sau bàn giao

## Files Expected
- `seo-web-app/app/Models/*`
- `seo-web-app/database/migrations/*`
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/marketplace/services/show.blade.php`
- `seo-web-app/resources/views/admin/marketplace/*`
- `seo-web-app/tests/Feature/FeedbackSocialProofTest.php`

## Implementation Notes
- Nếu chưa muốn tạo CRUD lớn, có thể bắt đầu từ module admin tối giản nhưng dữ liệu phải có cấu trúc.
- Không dùng testimonial thiếu ngữ cảnh hoặc copy quá chung chung.

## Done When
- Website có social proof rõ ràng, không chỉ là self-claim.
- Feedback có thể publish/unpublish và sắp thứ tự.

## Test Requirements
- Test public chỉ thấy feedback publish.
- Test admin access nếu có CRUD.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: add feedback and social proof module
