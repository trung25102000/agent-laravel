# Task: FAQ And Contact CTA System

## Status
completed

## Priority
medium

## Objective
Xây dựng hệ thống FAQ và CTA liên hệ qua Zalo/Facebook/Email cho shop nhỏ, cá nhân kinh doanh online và sinh viên.

## Requirements
- Tạo model `FaqItem` nếu cần quản trị động.
- FAQ phân nhóm: shop nhỏ, landing page/kinh doanh online, sinh viên đồ án.
- CTA component tái sử dụng cho Zalo/Facebook/Email.
- Config thông tin liên hệ qua env/config, không hard-code rải rác.
- Public hiển thị FAQ ở trang dịch vụ/gói giá/template/detail.
- Admin CRUD FAQ nếu chọn dynamic.

## Files Expected
- `video-generator-app/config/contact.php`
- `video-generator-app/app/Models/FaqItem.php`
- `video-generator-app/database/migrations/*create_faq_items_table.php`
- `video-generator-app/app/Http/Controllers/Admin/FaqItemController.php`
- `video-generator-app/resources/views/components/contact-cta.blade.php`
- `video-generator-app/resources/views/components/faq-list.blade.php`
- `video-generator-app/resources/views/admin/faq-items/*`
- `video-generator-app/tests/Feature/FaqAndContactCtaTest.php`

## Implementation Notes
- Nếu chưa cần dynamic FAQ, có thể dùng config trước nhưng phải dễ nâng cấp.
- Link Zalo/Facebook/Email phải validate/sanitize.
- CTA text thân thiện, dễ hiểu.

## Done When
- FAQ hiển thị theo nhóm khách hàng.
- CTA Zalo/Facebook/Email tái sử dụng được.
- Admin quản lý FAQ nếu dynamic.

## Test Requirements
- Test config contact render đúng.
- Test FAQ theo nhóm hiển thị.
- Test admin CRUD FAQ nếu có.

## Suggested Git Commit Message
- `feat: add FAQ and contact CTA system`
