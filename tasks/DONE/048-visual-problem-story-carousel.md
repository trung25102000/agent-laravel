# Task: Bổ sung slideshow/carousel trực quan cho storytelling vấn đề và giải pháp

## Status
completed

## Priority
high

## Objective
Nâng cấp Landing Page của `seo-web-app` bằng một section slideshow/carousel trực quan, tự động chuyển đổi giữa các vấn đề/khó khăn người dùng thường gặp và giải pháp tương ứng. Mục tiêu là tăng tính thu hút, tạo cảm giác hiện đại, giúp người dùng mới dễ hình dung bối cảnh trước khi hiểu giá trị dịch vụ.

## Requirements
- Ưu tiên sử dụng hình ảnh/visual trực quan trên giao diện:
  - Có thể dùng CSS mockup tự dựng, illustration bằng HTML/CSS, hoặc asset tự tạo trong project.
  - Không dùng ảnh ngoài không rõ license.
  - Visual phải mô tả được tình huống thực tế: shop nhỏ, landing page quảng cáo, người bán online, sinh viên làm đồ án.
- Xây dựng section vấn đề/khó khăn dạng slideshow hoặc carousel:
  - Mỗi slide gồm:
    - visual/hình ảnh minh họa
    - tiêu đề vấn đề
    - mô tả ngắn
    - giải pháp hoặc lợi ích Web Template Studio cung cấp
    - CTA nhỏ hoặc hint liên hệ nếu phù hợp
  - Carousel nên có ít nhất 4 slide:
    - Shop nhỏ thiếu website chuyên nghiệp.
    - Landing page quảng cáo thiếu tin cậy/không thu lead.
    - Người bán online phụ thuộc Facebook/Zalo.
    - Sinh viên có source nhưng thiếu database/báo cáo/hướng dẫn.
- Auto-play:
  - Slide tự động chuyển sau vài giây.
  - Có animation mượt khi chuyển slide.
  - Không làm người dùng mất quyền kiểm soát: có nút hoặc indicator để chọn slide.
  - Khi hover/focus vào carousel nên tạm dừng hoặc không gây khó chịu.
- Storytelling:
  - Nội dung hiển thị theo từng bước hoặc từng câu chuyện nhỏ.
  - Người dùng phải hiểu được:
    - vấn đề đang gặp là gì
    - vì sao vấn đề đó làm giảm niềm tin/chuyển đổi
    - dịch vụ giải quyết bằng website/landing/source như thế nào
  - Copy ngắn, dễ scan trên mobile.
- Animation:
  - Hiệu ứng chuyển ảnh/slide nhẹ nhàng, chuyên nghiệp.
  - Dùng fade/slide/scale nhẹ, không nhấp nháy.
  - Tôn trọng `prefers-reduced-motion`.
  - Không làm layout shift khi chuyển slide.
- Responsive:
  - Mobile hiển thị rõ từng slide, không tràn text.
  - Indicator/nút điều hướng dễ bấm.
  - Visual không che CTA hoặc nội dung.
- Accessibility:
  - Carousel có label/role phù hợp.
  - Button điều hướng có accessible name.
  - Slide active có trạng thái rõ ràng.
  - Nội dung vẫn đọc được nếu JS không chạy.
- Performance:
  - Không thêm thư viện carousel nặng nếu vanilla JS đủ dùng.
  - Nếu dùng asset hình, cần kích thước hợp lý và lazy loading khi phù hợp.

## Files Expected
- `/seo-web-app/resources/views/marketplace/home.blade.php`
- `/seo-web-app/resources/css/app.css`
- `/seo-web-app/resources/js/app.js`
- `/seo-web-app/tests/Feature/ProblemStoryCarouselTest.php`
- `/.agents/memory/progress.md`
- `/.agents/memory/changelog.md`
- `/.agents/memory/bugs.md` nếu phát sinh lỗi đã xử lý

## Implementation Notes
- Ưu tiên vanilla JS:
  - tìm container bằng `data-story-carousel`
  - slide bằng `data-story-slide`
  - controls bằng `data-story-control`
  - tự động chuyển bằng `setInterval`
  - pause khi `mouseenter`, `focusin`; resume khi `mouseleave`, `focusout`
- HTML fallback:
  - Nếu JS tắt, các slide vẫn hiển thị được hoặc ít nhất slide đầu có nội dung đầy đủ.
  - Không phụ thuộc hoàn toàn vào JS để hiểu thông tin chính.
- CSS gợi ý:
  - `.story-slide`
  - `.story-slide.is-active`
  - `.story-visual`
  - transition `opacity`, `transform`
  - min-height ổn định để tránh layout shift.
- Có thể thay thế hoặc bổ sung cho section `data-landing-section="problems"` hiện tại.
- Không làm mất các section đã có từ task 047:
  - hero
  - problems
  - solutions/value
  - trust
  - contact CTA
- Test nên kiểm tra marker HTML và nội dung chính, không cần test timer thực tế quá phức tạp.

## Done When
- Homepage có section slideshow/carousel trực quan cho vấn đề người dùng.
- Carousel có ít nhất 4 slide với visual + problem + solution.
- Slide tự động chuyển sau vài giây khi JS chạy.
- Có indicator hoặc control để người dùng chọn slide.
- Animation chuyển slide nhẹ, không gây layout shift rõ ràng.
- Reduced motion được hỗ trợ.
- Mobile không overlap, không tràn text, CTA vẫn rõ.
- Browser smoke test không có lỗi JS console nghiêm trọng.

## Test Requirements
- Feature test xác nhận homepage có carousel markers:
  - `data-story-carousel`
  - `data-story-slide`
  - `data-story-control`
- Feature test xác nhận có ít nhất 4 nội dung vấn đề chính.
- Test asset JS/CSS có logic hoặc selector carousel cần thiết.
- Chạy trong `/seo-web-app`:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
  - `npm run build`
  - `vendor/bin/pint`
- Browser smoke test:
  - Mở `/`
  - Kiểm tra carousel render.
  - Kiểm tra indicator/control hiện.
  - Kiểm tra console không có lỗi JS.

## Suggested Git Commit Message
- feat: add visual problem story carousel
