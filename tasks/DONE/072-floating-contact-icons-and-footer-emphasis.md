# Task: Floating Contact Icons And Footer Emphasis

## Status
pending

## Priority
high

## Objective
Điều chỉnh lớp contact/footer trên public site để tăng khả năng liên hệ nhanh: bỏ section “Công nghệ sử dụng”, thay nhóm link Zalo/Facebook/Email bằng cụm icon nổi cố định góc phải dưới màn hình, đồng thời làm footer nổi bật và có cảm giác chuyên nghiệp hơn.

## Requirements
- Xóa section `Công nghệ sử dụng` khỏi homepage.
- Thay cụm contact links dạng text hiện tại bằng floating contact icons:
  - Zalo
  - Facebook
  - Email
- Floating icons phải nằm góc phải dưới màn hình.
- Floating icons phải:
  - dễ bấm trên mobile
  - không che CTA/form chính
  - có hover/focus state rõ
  - giữ reduced-motion hợp lý
- Footer cần được làm nổi bật hơn:
  - rõ branding
  - rõ contact channels
  - rõ CTA hoặc trust copy ngắn
  - không nhìn như phần kết thúc quá mờ nhạt

## Subtasks
- Audit current homepage tech section, sticky CTA và contact channel placement.
- Xóa section `Công nghệ sử dụng` khỏi homepage và cập nhật test markers liên quan.
- Thiết kế floating contact icon group cho Zalo/Facebook/Email ở góc phải dưới.
- Đảm bảo floating group không xung đột với sticky CTA mobile hiện có.
- Thiết kế footer mới nổi bật hơn, đồng bộ visual system hiện tại.
- Cập nhật tests cho homepage/layout/contact markers nếu cần.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/layouts/app.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`
- `seo-web-app/tests/Feature/ContactChannelCtaTest.php`

## Implementation Notes
- Không chỉ đổi text thành icon đơn thuần; cụm contact phải nhìn như quick-action nổi có chủ đích.
- Nếu giữ sticky CTA mobile, cần tính khoảng cách và stacking rõ để không chồng lên form hoặc floating icons.
- Footer nên bám branding service-first platform hiện tại, không quay lại style marketplace cũ.

## Done When
- Homepage không còn section `Công nghệ sử dụng`.
- Zalo/Facebook/Email xuất hiện thành cụm icon nổi góc phải dưới và usable trên mobile/desktop.
- Footer đủ nổi bật để làm điểm kết thúc trang đáng tin cậy.

## Test Requirements
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: replace contact links with floating icons and strengthen footer
