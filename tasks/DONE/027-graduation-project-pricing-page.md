# Task: Graduation Project Pricing Page

## Status
completed

## Priority
high

## Objective
Tạo trang gói đồ án tốt nghiệp cho sinh viên cần source code Laravel, database mẫu, báo cáo hướng dẫn và tài liệu cài đặt/chạy project.

## Requirements
- Route public `GET /pricing/graduation-project`.
- Hiển thị các gói đồ án: source cơ bản, source + database + hướng dẫn, trọn gói báo cáo.
- Nêu rõ có source Laravel, database mẫu, tài liệu setup, hướng dẫn chạy project.
- Có CTA đặt làm đồ án.
- Có FAQ cho sinh viên.
- Có cảnh báo trung thực về phạm vi hỗ trợ và trách nhiệm học thuật nếu cần.

## Files Expected
- `video-generator-app/app/Http/Controllers/GraduationProjectPricingController.php`
- `video-generator-app/resources/views/pricing/graduation-project.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/GraduationProjectPricingTest.php`

## Implementation Notes
- Dùng package `audience_type=student`.
- CTA dẫn tới form đặt làm đồ án.
- Nội dung tránh cam kết sai sự thật hoặc gian lận học thuật.

## Done When
- Sinh viên xem được gói đồ án.
- CTA đặt làm đồ án hoạt động.
- FAQ sinh viên hiển thị.

## Test Requirements
- Test page 200.
- Test có source Laravel, database mẫu, báo cáo, hướng dẫn.
- Test CTA tới form đồ án.

## Suggested Git Commit Message
- `feat: add graduation project pricing page`
