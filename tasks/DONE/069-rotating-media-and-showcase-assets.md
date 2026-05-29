# Task: Rotating Media And Showcase Assets

## Status
completed

## Priority
medium

## Objective
Thêm hệ media luân phiên 3-5 giây cho homepage để tạo cảm giác sống động hơn bằng các visual như website mockup, coding scene, mobile app preview và SEO chart.

## Requirements
- Có luồng hiển thị rotating media 3-5 giây/lần.
- Ưu tiên media type:
  - website mockup
  - laptop coding
  - mobile app preview
  - dashboard analytics
  - SEO ranking chart
  - team working
- Hình ảnh ưu tiên trông thật hơn icon thuần.
- Có fallback khi chưa có asset thật: mockup hoặc visual composited hợp lý.
- Tương thích reduced-motion.

## Subtasks
- Xác định media strategy: asset thật, mockup nội bộ, hay pure CSS/HTML scenes.
- Thêm rotating logic vào hero hoặc showcase section phù hợp.
- Kiểm tra preload/lazy loading để tránh performance kém.
- Cập nhật tests nếu cần.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `memory/bugs.md` nếu gặp issue asset/performance

## Implementation Notes
- Task này nên phối hợp với `063` và `068`.
- Không thêm asset nặng nếu chưa có chiến lược tối ưu.

## Done When
- Homepage có rotating visual showcase rõ ràng và mượt.
- Media không làm giảm đáng kể trải nghiệm load.

## Test Requirements
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: add rotating media showcase to homepage
