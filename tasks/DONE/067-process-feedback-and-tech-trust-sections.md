# Task: Process Feedback And Tech Trust Sections

## Status
completed

## Priority
high

## Objective
Xây dựng 3 section trust mạnh hơn cho homepage: quy trình làm việc, feedback carousel và marquee công nghệ.

## Requirements
- Section Quy trình làm việc dạng timeline hiện đại:
  - Tiếp nhận yêu cầu
  - Phân tích
  - Báo giá
  - Thực hiện
  - Bàn giao
  - Hỗ trợ
- Section Feedback:
  - dạng carousel
  - auto rotate 5 giây
  - có avatar và rating
- Section Công nghệ:
  - Laravel
  - PHP
  - React
  - Next.js
  - MySQL
  - Docker
  - AWS
  - Redis
  - Linux
  - hiển thị dạng marquee animation

## Subtasks
- Nâng cấp section process hiện tại thành timeline rõ hơn.
- Tích hợp dữ liệu feedback từ task `055` hoặc tạo placeholder có cấu trúc chờ module thật.
- Thiết kế tech stack marquee với logo/text badges.
- Thêm animation auto-rotate và reduced-motion fallback.
- Cập nhật tests.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/FeedbackSocialProofTest.php`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`

## Implementation Notes
- Nếu `055` chưa xong, có thể cần dependency note.
- Tech marquee không được gây khó chịu hoặc quá chói.

## Done When
- Homepage có process timeline rõ, feedback carousel sống động và section công nghệ tăng trust kỹ thuật.
- Reduced motion được hỗ trợ.

## Test Requirements
- Test markers cho process, feedback carousel và tech marquee.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: add process feedback and tech trust sections
