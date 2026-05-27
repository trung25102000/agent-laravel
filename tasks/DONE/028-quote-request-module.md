# Task: Quote Request Module

## Status
completed

## Priority
high

## Objective
Xây dựng form yêu cầu báo giá cho shop nhỏ và cá nhân kinh doanh online, lưu lead để admin tư vấn và phản hồi.

## Requirements
- Tạo model `QuoteRequest` hoặc mở rộng order/lead model hiện có.
- Form nhận tên, email, phone, kênh liên hệ ưu tiên, nhóm khách hàng, loại website, ngân sách, deadline, mô tả nhu cầu.
- Có checkbox/field chọn Zalo/Facebook/Email.
- Status: new, contacted, quoted, won, lost.
- Rate limit form public.
- Admin quản lý lead/yêu cầu báo giá.

## Files Expected
- `video-generator-app/app/Models/QuoteRequest.php`
- `video-generator-app/database/migrations/*create_quote_requests_table.php`
- `video-generator-app/app/Enums/QuoteRequestStatusEnum.php`
- `video-generator-app/app/Http/Controllers/QuoteRequestController.php`
- `video-generator-app/app/Http/Controllers/Admin/QuoteRequestController.php`
- `video-generator-app/app/Http/Requests/StoreQuoteRequestRequest.php`
- `video-generator-app/resources/views/quote-requests/create.blade.php`
- `video-generator-app/resources/views/admin/quote-requests/*`
- `video-generator-app/tests/Feature/QuoteRequestTest.php`

## Implementation Notes
- Có thể dùng `CustomerUpsertService` nếu đã có.
- Public chỉ submit, không xem danh sách.
- Admin routes bảo vệ bằng admin auth.

## Done When
- Khách gửi yêu cầu báo giá thành công.
- Admin xem/filter/cập nhật status lead.
- Rate limit/validation hoạt động.

## Test Requirements
- Test submit quote request success.
- Test validation fail.
- Test admin listing/update status.
- Test guest/non-admin không vào admin.

## Suggested Git Commit Message
- `feat: add quote request lead module`
