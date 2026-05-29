# Task: Homepage Conversion CRO Polish

## Status
completed

## Priority
high

## Objective
Rà soát lại toàn bộ homepage sau các task UI để tối ưu conversion thực sự, không chỉ đẹp hơn.

## Requirements
- Kiểm tra lại hành trình người dùng:
  - vào trang
  - hiểu offer
  - thấy trust
  - xem dự án
  - bấm CTA
  - gửi form
- Tối ưu các yếu tố tăng chuyển đổi:
  - CTA placement
  - copy rõ giá trị
  - section order
  - visual emphasis
  - mobile-first contact flow
- Loại bỏ hoặc giảm các block đẹp nhưng không giúp conversion.
- Kiểm tra “muốn liên hệ ngay” có thực sự mạnh hơn chưa.

## Subtasks
- Audit homepage sau các task `063-069`.
- Chỉnh thứ tự section, copy và CTA.
- Tối ưu số lượng CTA chính/phụ.
- Cập nhật tests nếu copy chính thay đổi.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/components/contact-cta.blade.php`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`
- `seo-web-app/tests/Feature/ConsultationFunnelTest.php`

## Implementation Notes
- Đây là task CRO/polish, không phải nơi nhét thêm nhiều feature mới.
- Nên dựa trên output của các task UI trước đó.

## Done When
- Homepage thuyết phục hơn rõ rệt về mặt conversion.
- CTA và flow liên hệ hợp lý trên cả desktop lẫn mobile.

## Test Requirements
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: polish homepage for stronger conversion
