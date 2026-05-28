# Task: Tách frontend, layout và branding cho từng dự án

## Status
completed

## Priority
medium

## Objective
Mỗi app có giao diện, layout, asset build và branding riêng, không còn copy/video text lẫn trong SEO-web hoặc marketplace text lẫn trong video app.

## Requirements
- `seo-web-app` branding:
  - tên app: SEO Web Marketplace hoặc Web Template Studio.
  - navigation: Dịch vụ, Mẫu web, Gói giá, Source Laravel, Blog, Đăng nhập/Admin.
  - màu sắc trẻ trung, thân thiện, dễ gần.
  - CTA Zalo/Facebook/Email rõ ràng.
- `video-generator-app` branding:
  - tên app: AI Video Generator.
  - navigation: Dashboard, New AI video, Admin video, Preview.
  - tập trung video AI, render, preview/download.
- Mỗi app có Vite build riêng.
- Mỗi app có layout Blade riêng.
- Không dùng asset build của app này cho app kia.

## Files Expected
- `/seo-web-app/resources/views/layouts/app.blade.php`
- `/seo-web-app/resources/css/app.css`
- `/seo-web-app/resources/js/app.js`
- `/seo-web-app/vite.config.js`
- `/video-generator-app/resources/views/layouts/app.blade.php`
- `/video-generator-app/resources/css/app.css`
- `/video-generator-app/resources/js/app.js`
- `/video-generator-app/vite.config.js`

## Implementation Notes
- Không cần đổi sang Inertia/React nếu Blade hiện đáp ứng đủ.
- Kiểm tra text trong view bằng `rg "AI Video|Template|Laravel"` để tránh branding lẫn.
- Build cả hai app trước khi hoàn tất.

## Done When
- SEO-web hiển thị đúng thương hiệu marketplace.
- Video app hiển thị đúng thương hiệu AI video.
- Không có navigation cross-domain không chủ ý.
- `npm run build` pass trong cả hai app.

## Test Requirements
- Feature test landing/layout cho từng app.
- Browser smoke test `/` của từng app.
- `npm run build` trong cả hai app.

## Suggested Git Commit Message
- refactor: separate frontend branding for seo web and video apps
