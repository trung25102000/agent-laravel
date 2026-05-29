# Task: Visual System Colors And Motion Foundation

## Status
completed

## Priority
high

## Objective
Thiết lập lại visual system toàn homepage và các section public để loại bỏ cảm giác trắng đơn điệu và tạo một ngôn ngữ hình ảnh agency chuyên nghiệp.

## Requirements
- Áp dụng palette mới:
  - Primary `#2563EB`
  - Secondary `#7C3AED`
  - Accent `#06B6D4`
  - Success `#10B981`
  - Dark `#0F172A`
  - Background gradient hiện đại
- Tạo hoặc refactor design tokens/CSS variables.
- Bổ sung và chuẩn hóa motion:
  - Fade In
  - Slide Up
  - Scroll Reveal
  - Count Up
  - Hover Animation
  - Floating Animation
  - Background Particle
  - Gradient Blur
  - Skeleton Loading
- Đảm bảo consistency giữa homepage, services, portfolio, feedback và CTA sections.

## Subtasks
- Audit màu sắc và motion đang có.
- Refactor CSS variables/theme tokens.
- Tạo reusable motion classes.
- Thêm background treatment, blur, particles nếu phù hợp.
- Cập nhật tests/assets markers nếu cần.

## Files Expected
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/resources/views/layouts/app.blade.php`
- `seo-web-app/tests/Feature/AnimatedTrustVisualsTest.php`

## Implementation Notes
- Không được làm site thành “AI slop” quá màu mè.
- Hiệu ứng phải phục vụ conversion chứ không phải để khoe kỹ thuật.
- Skeleton loading có thể áp dụng cho carousel/portfolio hoặc image-heavy blocks.

## Done When
- Toàn site có visual system rõ và chuyên nghiệp hơn.
- Màu sắc mới được dùng nhất quán.
- Motion có hệ thống, không chắp vá.

## Test Requirements
- Test asset markers mới.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: establish stronger visual system and motion foundation
