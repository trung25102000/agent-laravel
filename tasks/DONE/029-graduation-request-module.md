# Task: Graduation Request Module

## Status
completed

## Priority
high

## Objective
Xây dựng form đặt làm đồ án cho sinh viên và màn hình admin quản lý yêu cầu đồ án.

## Requirements
- Tạo model `GraduationProjectRequest`.
- Form nhận thông tin sinh viên, ngành/chủ đề, công nghệ yêu cầu, deadline, yêu cầu source, database, báo cáo, hướng dẫn.
- Cho phép chọn gói đồ án.
- Status: new, consulting, quoted, in_progress, delivered, cancelled.
- Admin xem/filter/cập nhật status/note.
- Có cảnh báo phạm vi hỗ trợ học thuật phù hợp.

## Files Expected
- `video-generator-app/app/Models/GraduationProjectRequest.php`
- `video-generator-app/database/migrations/*create_graduation_project_requests_table.php`
- `video-generator-app/app/Enums/GraduationProjectRequestStatusEnum.php`
- `video-generator-app/app/Http/Controllers/GraduationProjectRequestController.php`
- `video-generator-app/app/Http/Controllers/Admin/GraduationProjectRequestController.php`
- `video-generator-app/app/Http/Requests/StoreGraduationProjectRequestRequest.php`
- `video-generator-app/resources/views/graduation-projects/request.blade.php`
- `video-generator-app/resources/views/admin/graduation-project-requests/*`
- `video-generator-app/tests/Feature/GraduationProjectRequestTest.php`

## Implementation Notes
- Không yêu cầu upload file ở form đầu nếu chưa cần.
- Có thể liên kết Customer.
- Admin note không public.

## Done When
- Sinh viên gửi yêu cầu đồ án được.
- Admin quản lý yêu cầu đồ án.
- Validation/status hoạt động.

## Test Requirements
- Test submit graduation request.
- Test validation fail.
- Test admin update status/note.
- Test non-admin forbidden.

## Suggested Git Commit Message
- `feat: add graduation project request module`
