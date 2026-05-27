# Task: Youthful Friendly UI

## Status
completed

## Priority
high

## Objective
Hoàn thiện giao diện trẻ trung, thân thiện, dễ gần cho người dùng thuộc 3 nhóm: chủ shop nhỏ/lẻ, cá nhân kinh doanh online và sinh viên.

## Requirements
- Giao diện có màu sắc tươi sáng, hiện đại, không cứng nhắc.
- Nội dung, CTA và icon gần gũi với người không rành kỹ thuật.
- Có visual language riêng cho từng nhóm khách hàng.
- Navigation rõ ràng: Dịch vụ, Mẫu web, Gói giá, Đồ án, Blog, Liên hệ.
- CTA nổi bật: Zalo, Facebook, Email, nhận báo giá.
- Mobile-first, không overlap text, không dùng layout quá rối.
- Không giữ title/copy mặc định của Laravel.

## Files Expected
- `video-generator-app/resources/views/layouts/app.blade.php`
- `video-generator-app/resources/views/components/*`
- `video-generator-app/resources/css/app.css`
- `video-generator-app/resources/views/home.blade.php`
- `video-generator-app/tests/Feature/YouthfulUiTest.php`

## Implementation Notes
- Dùng TailwindCSS hiện có.
- Ưu tiên component Blade tái sử dụng cho CTA, audience card, service card.
- Không dùng gradient/orb trang trí quá nhiều.
- Text tiếng Việt ngắn, rõ, bán hàng nhẹ nhàng.

## Done When
- Public UI nhìn trẻ trung, thân thiện, dễ dùng.
- 3 nhóm khách hàng nhìn thấy lối đi riêng.
- CTA liên hệ rõ trên desktop/mobile.
- Test UI cơ bản pass.

## Test Requirements
- Test homepage không còn copy mặc định Laravel.
- Test có CTA Zalo/Facebook/Email.
- Test có nội dung cho shop nhỏ, cá nhân online, sinh viên.

## Suggested Git Commit Message
- `feat: polish youthful marketplace UI`
