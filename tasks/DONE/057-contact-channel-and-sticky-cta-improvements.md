# Task: Contact Channel And Sticky CTA Improvements

## Status
completed

## Priority
medium

## Objective
Làm rõ các kênh liên hệ và CTA chuyển đổi để khách hàng dễ chat/gửi yêu cầu hơn trên mobile và desktop.

## Requirements
- Tăng độ hiện diện của Zalo, Facebook, email ở các vị trí hợp lý.
- Thêm hoặc tối ưu sticky CTA cho mobile nếu phù hợp:
  - tư vấn nhanh
  - nhắn Zalo
  - xem dịch vụ
- Chuẩn hóa contact copy trên toàn site:
  - thời gian phản hồi
  - loại hỗ trợ nhận làm
  - cách gửi mô tả nhu cầu
- Kiểm tra các CTA hiện có không bị trùng lặp, lộn xộn hoặc cạnh tranh nhau quá mức.
- Tối ưu accessibility cho nút liên hệ và action buttons.

## Files Expected
- `seo-web-app/resources/views/components/contact-cta.blade.php`
- `seo-web-app/resources/views/layouts/app.blade.php`
- `seo-web-app/resources/views/marketplace/*.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/ContactChannelCtaTest.php`

## Implementation Notes
- Sticky CTA không được che nội dung hoặc che nút submit form.
- Tránh spam quá nhiều nút nổi.

## Done When
- Các kênh liên hệ chính rõ ràng và nhất quán trên site.
- Mobile có CTA tiện dùng nhưng không gây rối.

## Test Requirements
- Test homepage/services/contact CTA render đúng.
- Browser smoke test mobile sticky CTA.
- Chạy trong `seo-web-app`:
  - `php artisan test`
  - `npm run build`

## Suggested Git Commit Message
- feat: improve contact channels and sticky ctas
