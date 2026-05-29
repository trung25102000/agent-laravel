# Task: Quick Consultation And Quote Funnel Optimization

## Status
completed

## Priority
high

## Objective
Tối ưu funnel nhận yêu cầu để khách hàng có thể gửi nhu cầu nhanh, rõ loại dịch vụ cần hỗ trợ và dễ được tư vấn/báo giá.

## Requirements
- Rà soát các form hiện có:
  - order request
  - quote request
  - graduation project request
  - contact message
- Thiết kế lại để người dùng phổ thông dễ chọn đúng form.
- Thêm hoặc cải thiện form “tư vấn nhanh” / “báo giá nhanh” với các field phù hợp:
  - loại dịch vụ
  - mô tả nhu cầu
  - ngân sách tham khảo
  - deadline
  - công nghệ liên quan
  - kênh liên hệ ưu tiên
- Nếu hợp lý, chuẩn hóa các form bằng shared UI component hoặc một landing funnel rõ hơn.
- Hiển thị success/error state rõ ràng và thân thiện.
- Rate limit, validation và anti-spam phải tiếp tục hoạt động.

## Files Expected
- `seo-web-app/app/Http/Requests/StoreQuoteRequestRequest.php`
- `seo-web-app/app/Http/Requests/StoreContactMessageRequest.php`
- `seo-web-app/app/Http/Controllers/MarketplaceController.php`
- `seo-web-app/resources/views/marketplace/*`
- `seo-web-app/resources/views/components/*`
- `seo-web-app/tests/Feature/ConsultationFunnelTest.php`

## Implementation Notes
- Không làm tăng friction quá nhiều cho user mobile.
- Nếu giữ nhiều form riêng, phải làm rõ khi nào dùng form nào.
- Nếu thêm field công nghệ/dịch vụ mới, cập nhật schema và admin listing tương ứng.

## Done When
- Khách hàng mới có thể chọn đúng funnel và gửi yêu cầu nhanh.
- Form copy, field labels và CTA rõ ràng hơn hiện tại.
- Validation, rate limit và lưu lead vẫn pass.

## Test Requirements
- Test submit từng form chính.
- Test validation fail cho field bắt buộc.
- Test success message/redirect.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: optimize consultation and quote funnels
