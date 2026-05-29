# Task: Portfolio UI Showcase Upgrade

## Status
completed

## Priority
high

## Objective
Biến portfolio thành một section showcase giàu hình ảnh và trust hơn, giúp khách hàng thấy năng lực thực thi thực tế như một agency.

## Requirements
- Hiển thị project dưới dạng card lớn.
- Mỗi card nên có:
  - ảnh preview/mockup
  - công nghệ sử dụng
  - vai trò thực hiện
  - kết quả đạt được
  - CTA xem chi tiết/xem demo
- Hover animation phải rõ và mượt.
- Homepage cần có teaser portfolio hấp dẫn hơn hiện tại.
- Public portfolio index/show phải có visual polish, không chỉ là list dữ liệu.

## Subtasks
- Dùng output của task `054` làm data source chính.
- Thiết kế card portfolio lớn cho homepage teaser.
- Thiết kế index/show page chuyên nghiệp hơn.
- Tối ưu hover, reveal và visual balance.
- Bổ sung test UI markers nếu cần.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/marketplace/portfolio/index.blade.php`
- `seo-web-app/resources/views/marketplace/portfolio/show.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/tests/Feature/PortfolioCaseStudyTest.php`

## Implementation Notes
- Task này phụ thuộc dữ liệu/domain của `054`.
- Nếu `054` chưa xong, task này chỉ nên bắt đầu sau khi portfolio public route và data cơ bản đã có.

## Done When
- Portfolio nhìn như case study showcase thực thụ.
- Khách xem portfolio cảm nhận rõ năng lực kỹ thuật và khả năng bàn giao.

## Test Requirements
- Test portfolio pages vẫn render đúng.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: elevate portfolio into agency-style showcase
