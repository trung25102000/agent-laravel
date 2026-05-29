# Task: Hero Section Agency-Grade Redesign

## Status
completed

## Priority
high

## Objective
Thiết kế lại Hero Section của homepage để tạo ấn tượng mạnh trong 5 giây đầu tiên và thể hiện ngay đây là một đơn vị làm website, SEO, app và hỗ trợ kỹ thuật chuyên nghiệp.

## Requirements
- Thay thế hero hiện tại bằng bố cục 2 cột rõ ràng.
- Cột trái phải có:
  - headline lớn theo hướng chuyển đổi, ví dụ `Biến Ý Tưởng Thành Website Chuyên Nghiệp Chỉ Trong Vài Ngày`
  - subtitle/service bullets:
    - Thiết kế Website
    - Landing Page
    - SEO Website
    - Fix Bug
    - Hỗ Trợ Đồ Án
    - Phát Triển App Theo Yêu Cầu
  - CTA chính: `Nhận Tư Vấn Miễn Phí`
  - CTA phụ: `Xem Dự Án Đã Thực Hiện`
- Cột phải phải có visual động mang cảm giác agency:
  - website/wireframe transform
  - dashboard reveal
  - code typing animation
  - SEO ranking chart tăng trưởng
  - mobile app mockup
- Animation auto-cycle 3-5 giây/lần.
- Hero phải có chiều sâu thị giác: gradient blur, layered cards, motion và hierarchy rõ.

## Subtasks
- Audit hero hiện tại và xác định phần nào giữ lại được.
- Thiết kế lại copy hero theo service-first + conversion-first.
- Dựng visual mockup/scene animation bằng HTML/CSS/JS hoặc asset phù hợp.
- Thêm auto-cycle cho các state visual.
- Tối ưu hero cho desktop và mobile.
- Cập nhật test homepage theo hero mới.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`
- `seo-web-app/tests/Feature/BrandedEntryUiTest.php`

## Implementation Notes
- Không dùng animation nặng gây lag.
- Nếu chưa có ảnh thật, có thể dùng mockup composited bằng HTML/CSS nhưng phải đủ cảm giác chuyên nghiệp.
- Hero không được trông giống dashboard admin.

## Done When
- Hero nhìn vào là hiểu website bán dịch vụ công nghệ chuyên nghiệp.
- CTA chính/phụ nổi bật và rõ.
- Visual bên phải có motion, không tĩnh đơn điệu.
- Mobile vẫn đọc tốt, CTA dễ bấm.

## Test Requirements
- Test hero có marker mới và CTA mới.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: redesign homepage hero into agency-grade conversion section
