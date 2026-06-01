# Task: Homepage Landing

## Status
completed

## Priority
high

## Objective
Xây dựng trang chủ bán template và dịch vụ làm web có thông điệp rõ ràng cho 3 nhóm khách hàng chính: chủ shop nhỏ/lẻ, cá nhân kinh doanh online, và sinh viên cần đồ án/source Laravel.

## Requirements
- Hero section nói rõ website bán template, landing page, source Laravel và dịch vụ làm web.
- Có phân đoạn rõ cho 3 nhóm khách hàng:
  - Chủ shop nhỏ/lẻ: website giới thiệu, bán hàng đơn giản, landing page chốt đơn, catalog sản phẩm.
  - Cá nhân kinh doanh online: landing page chạy quảng cáo, form thu lead, CTA Zalo/Facebook.
  - Sinh viên: đồ án tốt nghiệp, source Laravel, database mẫu, báo cáo/hướng dẫn.
- Có CTA xem mẫu web và gửi yêu cầu tư vấn.
- Có CTA liên hệ nhanh qua Zalo/Facebook/Email.
- Có section benefits: nhanh, tối ưu SEO, dễ chỉnh sửa, hỗ trợ triển khai.
- Có featured templates lấy từ database nếu module template đã có, hoặc placeholder an toàn nếu chưa có.
- Có section dịch vụ theo yêu cầu.
- Giao diện responsive, thân thiện, không giống landing mặc định Laravel.
- SEO title/meta cơ bản cho trang chủ.

## Files Expected
- `video-generator-app/app/Http/Controllers/HomeController.php`
- `video-generator-app/resources/views/home.blade.php`
- `video-generator-app/resources/views/components/template-card.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/HomepageTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Nếu chưa có model template, truyền collection rỗng và render CTA fallback.
- Không query N+1 khi lấy featured templates.
- Text tiếng Việt rõ ràng, hướng conversion.
- Dùng Tailwind, tránh card lồng card.

## Done When
- `GET /` hiển thị landing hoàn chỉnh.
- Có CTA tới danh sách template và form liên hệ.
- Trang responsive trên mobile/desktop.
- Test public homepage pass.

## Test Requirements
- Feature test `GET /` trả 200.
- Assert có CTA xem mẫu web, liên hệ/tư vấn.
- Assert có nội dung cho shop nhỏ, kinh doanh online, sinh viên.
- Nếu có featured templates, test hiển thị template active.

## Suggested Git Commit Message
- `feat: build marketplace homepage landing page`
