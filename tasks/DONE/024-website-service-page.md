# Task: Website Service Page

## Status
completed

## Priority
high

## Objective
Xây dựng trang dịch vụ làm website theo yêu cầu cho shop nhỏ, cá nhân kinh doanh online và khách cần website giới thiệu/catalog/bán hàng đơn giản.

## Requirements
- Route public `GET /services`.
- Trình bày dịch vụ: website giới thiệu, website bán hàng đơn giản, catalog sản phẩm, landing page chốt đơn.
- Có section quy trình làm việc: tư vấn, chọn mẫu, chỉnh sửa, bàn giao, hỗ trợ.
- Có CTA yêu cầu báo giá và liên hệ Zalo/Facebook/Email.
- Có FAQ ngắn cho shop nhỏ.
- Có gói dịch vụ liên quan nếu module pricing đã có.

## Files Expected
- `video-generator-app/app/Http/Controllers/ServicePageController.php`
- `video-generator-app/resources/views/services/index.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/ServicePageTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Page nên đọc dữ liệu package active nếu module gói dịch vụ đã có.
- Nếu chưa có database package, render nội dung tĩnh an toàn.
- CTA nên dẫn tới form báo giá.

## Done When
- Trang dịch vụ public hoạt động.
- Nội dung rõ cho shop nhỏ và người kinh doanh online.
- CTA báo giá/liên hệ hoạt động.

## Test Requirements
- Test `GET /services` trả 200.
- Assert có website giới thiệu, catalog, landing page.
- Assert có CTA báo giá và Zalo/Facebook/Email.

## Suggested Git Commit Message
- `feat: add website service page`
