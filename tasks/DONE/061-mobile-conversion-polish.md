# Task: Mobile Conversion Polish

## Status
completed

## Priority
medium

## Objective
Tối ưu trải nghiệm mobile để người dùng nhỏ lẻ có thể hiểu dịch vụ và gửi yêu cầu dễ dàng ngay trên điện thoại.

## Requirements
- Kiểm tra toàn bộ route public chính trên mobile width:
  - homepage
  - services
  - service detail
  - pricing
  - portfolio
  - blog
  - contact funnels
- Sửa các vấn đề:
  - text quá dài khó scan
  - spacing dày hoặc mỏng bất thường
  - CTA khó bấm
  - overflow ngang
  - form dài gây mệt
  - sticky CTA che nội dung
- Tối ưu block quan trọng cho chuyển đổi:
  - hero
  - list dịch vụ
  - feedback
  - CTA
  - form liên hệ/báo giá

## Files Expected
- `seo-web-app/resources/views/marketplace/*.blade.php`
- `seo-web-app/resources/views/components/*.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/tests/Feature/MobileConversionUiTest.php`
- `.agents/memory/bugs.md`

## Implementation Notes
- Ưu tiên mobile-first, giữ trải nghiệm desktop không regress.
- Có thể cần thêm marker class hoặc test assertions để chặn regress phổ biến.

## Done When
- Public funnel dùng ổn trên mobile cho các trang chính.
- Không còn lỗi layout/CTA đáng kể ở viewport phổ biến.

## Test Requirements
- Test feature cho các marker UI quan trọng.
- Browser smoke test mobile.
- Chạy trong `seo-web-app`:
  - `php artisan test`
  - `npm run build`

## Suggested Git Commit Message
- feat: polish mobile conversion experience
