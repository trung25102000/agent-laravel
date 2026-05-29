# Task: Service Cards Visual Upgrade

## Status
completed

## Priority
high

## Objective
Nâng cấp section dịch vụ để mỗi service card có nhận diện thị giác rõ ràng, khác biệt và chuyên nghiệp hơn, tăng cảm giác giá trị dịch vụ.

## Requirements
- Mỗi service card phải có:
  - icon riêng
  - gradient riêng
  - hình minh họa hoặc mockup riêng
  - CTA rõ
- Các dịch vụ ưu tiên:
  - SEO Website
  - Website Development
  - Landing Page
  - Fix Bug
  - Student Project Support
  - Mobile App Development
  - Technical Consultation
- Card phải có hover animation, depth và visual polish tốt hơn.
- Nếu cần thêm service public mới như `Mobile App Development` hoặc `Technical Consultation`, phải ghi nhận vào task/domain phù hợp hoặc tạo seed tạm có chủ đích.

## Subtasks
- Audit `service_offerings` hiện có và mapping sang visual style.
- Thiết kế card system với biến màu/gradient riêng cho từng nhóm.
- Bổ sung iconography/illustration strategy.
- Cập nhật homepage và service listing dùng card mới.
- Cập nhật tests/markers khi cần.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/marketplace/services.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`
- `seo-web-app/tests/Feature/ServiceCatalogTest.php`

## Implementation Notes
- Không dùng icon mặc định nghèo nàn; visual phải có chủ đích.
- Nếu domain data chưa đủ cho 7 service như brief, tạo decision log hoặc task phụ cho seed/domain expansion.

## Done When
- Section dịch vụ có cảm giác cao cấp hơn rõ rệt.
- Mỗi card đủ khác biệt để người dùng nhớ được.
- CTA từ card dẫn đúng detail/funnel.

## Test Requirements
- Test service cards render đủ item/CTA.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: upgrade service cards with stronger visual identity
