# Task: Technical SEO And Performance Hardening

## Status
completed

## Priority
high

## Objective
Hoàn thiện phần technical SEO và hiệu năng cho `seo-web-app` để hỗ trợ đúng lời hứa dịch vụ SEO website và trải nghiệm người dùng tốt hơn.

## Requirements
- Rà soát:
  - title/meta description
  - canonical
  - heading structure
  - robots
  - sitemap
  - internal links
  - image alt text nếu có
- Tối ưu performance frontend:
  - giảm asset không cần thiết
  - kiểm tra layout shift
  - tối ưu section nặng ở homepage
  - rà soát JS chỉ dùng khi cần
- Kiểm tra responsive và UX cho mobile/tablet/desktop.
- Nếu cần, bổ sung structured data cơ bản cho service/business pages theo phạm vi an toàn.

## Files Expected
- `seo-web-app/resources/views/layouts/app.blade.php`
- `seo-web-app/resources/views/marketplace/*.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/TechnicalSeoTest.php`
- `seo-web-app/tests/Feature/PerformanceUiSmokeTest.php`
- `context/decisions.md`
- `memory/changelog.md`

## Implementation Notes
- Không thêm script tracking hay third-party nặng nếu chưa cần.
- Structured data phải đúng ngữ nghĩa, không spam schema.
- Giữ HTML semantic và accessible.

## Done When
- Public pages chính có technical SEO cơ bản tốt.
- Asset/build không có vấn đề rõ ràng về performance do thay đổi mới.
- Nội dung/markup phù hợp với định vị dịch vụ SEO website.

## Test Requirements
- Test sitemap/robots/meta/heading markers quan trọng.
- Chạy trong `seo-web-app`:
  - `php artisan test`
  - `npm run build`

## Suggested Git Commit Message
- feat: harden technical seo and frontend performance
