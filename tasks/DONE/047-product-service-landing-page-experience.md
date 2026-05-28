# Task: Cải thiện giao diện Landing Page cho người dùng

## Status
completed

## Priority
high

## Objective
Thiết kế lại trang chủ `seo-web-app` theo hướng Landing Page sản phẩm/dịch vụ hiện đại, trực quan và thuyết phục hơn. Giao diện cần tránh cảm giác giống trang quản trị hoặc dashboard nội bộ, thay vào đó tạo trải nghiệm giới thiệu dịch vụ rõ ràng trước khi người dùng đi vào các chức năng chính như xem mẫu web, gửi báo giá, đặt dịch vụ hoặc mua source Laravel.

## Requirements
- Thiết kế lại homepage theo phong cách landing page:
  - First viewport phải tạo ấn tượng mạnh ngay khi vào trang.
  - Hero cần có headline rõ giá trị, subcopy dễ hiểu, CTA chính/phụ nổi bật.
  - Có visual chính mang tính sản phẩm/dịch vụ, ví dụ mockup website, landing page, form lead, dashboard demo hoặc bộ giao diện mẫu.
  - Không làm giao diện giống admin dashboard, bảng quản lý, danh sách dữ liệu khô cứng.
- Tăng storytelling:
  - Trang cần dẫn dắt người dùng từ vấn đề thực tế đến giải pháp.
  - Có section mô tả các khó khăn/vấn đề người dùng thường gặp trước khi thuê làm web.
  - Có section giải thích hệ thống/dịch vụ giúp xử lý các vấn đề đó như thế nào.
  - Có section mô tả quy trình làm việc theo ngôn ngữ dễ hiểu với khách hàng phổ thông.
- Bổ sung section “vấn đề người dùng gặp phải”:
  - Chủ shop nhỏ chưa có website chuyên nghiệp.
  - Landing page chạy quảng cáo thiếu tin cậy, không thu được lead.
  - Người bán online phụ thuộc hoàn toàn vào Facebook/Zalo.
  - Sinh viên có source code nhưng thiếu database, báo cáo, hướng dẫn chạy.
  - Khách không biết chọn gói nào, sợ chi phí phát sinh hoặc không được hỗ trợ.
- Bổ sung section “giá trị hệ thống/dịch vụ mang lại”:
  - Có demo trước khi bàn giao.
  - Giao diện đẹp, dễ chỉnh sửa, tối ưu mobile.
  - Có form thu lead và CTA Zalo/Facebook/Email rõ ràng.
  - Có source, database, tài liệu cài đặt nếu mua source/đồ án.
  - Có hỗ trợ deploy/chỉnh sửa sau bàn giao.
- Animation và motion:
  - Có hiệu ứng khi load trang cho hero, CTA và visual chính.
  - Có scroll reveal cho từng section.
  - Hình ảnh/icon/nội dung xuất hiện lần lượt, không đồng loạt.
  - Hover animation cho card, package, template preview và CTA.
  - Animation phải mượt, nhẹ, không gây rối hoặc nhấp nháy.
  - Tôn trọng `prefers-reduced-motion`.
- UI/UX:
  - Giao diện trẻ trung, thân thiện, dễ tiếp cận với người dùng cuối.
  - CTA phải rõ ở các section quan trọng.
  - Nội dung phải dễ scan trên mobile.
  - Không dùng layout quá giống trang admin: tránh table-like blocks, quá nhiều stat boxes cứng, quá nhiều card đồng dạng không có storytelling.
  - Mỗi section cần có vai trò rõ trong hành trình thuyết phục người dùng.
- Responsive:
  - Mobile first, không tràn chữ, không overlap visual.
  - Hero không chiếm toàn bộ trang khiến người dùng không thấy nội dung kế tiếp.
  - CTA vẫn dễ bấm trên màn hình nhỏ.
- Trust và conversion:
  - Có trust badge hoặc proof block.
  - Có CTA liên hệ Zalo/Facebook/Email.
  - Có block nhấn mạnh “xem demo trước”, “bàn giao source/tài liệu”, “hỗ trợ sau bàn giao”.

## Files Expected
- `/seo-web-app/resources/views/marketplace/home.blade.php`
- `/seo-web-app/resources/views/components/contact-cta.blade.php`
- `/seo-web-app/resources/views/components/template-card.blade.php`
- `/seo-web-app/resources/css/app.css`
- `/seo-web-app/resources/js/app.js`
- `/seo-web-app/tests/Feature/LandingPageExperienceTest.php`
- `/seo-web-app/README.md` nếu có thay đổi cách build hoặc asset
- `/memory/progress.md`
- `/memory/changelog.md`

## Implementation Notes
- Ưu tiên Blade + Tailwind + CSS/vanilla JS hiện có.
- Không thêm thư viện animation nặng nếu chưa thật sự cần.
- Có thể tái sử dụng hệ thống `data-reveal`, `.motion-card`, `.motion-float` đã có từ task 046.
- Nếu cần stagger animation:
  - dùng CSS custom property như `style="--reveal-delay: 120ms"`
  - hoặc dùng class delay ngắn có kiểm soát.
- Hero nên có cấu trúc gợi ý:
  - eyebrow: nhóm khách hàng hoặc cam kết nhanh
  - H1: offer chính
  - paragraph: lợi ích rõ ràng
  - CTA chính: nhận tư vấn/báo giá
  - CTA phụ: xem mẫu web/demo
  - visual: mockup website/landing/source Laravel
- Section flow gợi ý:
  - Hero sản phẩm/dịch vụ
  - Problem section: “Bạn có đang gặp những vấn đề này?”
  - Solution/value section
  - Audience section cho shop nhỏ, người bán online, sinh viên
  - Demo/template preview
  - Process section
  - Trust/proof section
  - Pricing teaser
  - Contact CTA
  - FAQ
- Copywriting phải tự nhiên, dễ hiểu, không quá kỹ thuật.
- Các yếu tố kỹ thuật như Laravel/source/database chỉ nên xuất hiện rõ ở nhóm sinh viên hoặc source code, không làm rối nhóm shop nhỏ.
- Không dùng ảnh ngoài không rõ license. Ưu tiên CSS mockup hoặc asset tự tạo.
- Kiểm tra UI bằng browser sau build ở desktop và mobile width.

## Done When
- Homepage có cảm giác rõ ràng là landing page sản phẩm/dịch vụ, không giống admin dashboard.
- First viewport có hero hấp dẫn, visual chính và CTA rõ ràng.
- Có section vấn đề người dùng gặp phải.
- Có section giá trị/lợi ích hệ thống mang lại.
- Có storytelling liền mạch từ problem đến solution đến CTA.
- Có animation load/scroll/hover mượt và không gây rối.
- Reduced motion được hỗ trợ.
- Mobile không overlap, không mất CTA, không tràn text.
- Browser smoke test pass cho homepage desktop và mobile.
- Không còn task pending liên quan task này sau khi hoàn tất workflow.

## Test Requirements
- Feature test xác nhận homepage có các section chính:
  - hero landing page
  - problem section
  - solution/value section
  - trust/proof block
  - contact CTA
- Feature test xác nhận homepage có marker animation/reveal.
- Feature test xác nhận public UI không chứa copy mặc định Laravel/admin dashboard không phù hợp.
- Chạy trong `/seo-web-app`:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
  - `npm run build`
  - `vendor/bin/pint`
- Browser smoke test:
  - Mở `/`
  - Kiểm tra desktop hero + problem/value sections.
  - Kiểm tra mobile width không overlap.
  - Kiểm tra console không có lỗi JS nghiêm trọng.

## Suggested Git Commit Message
- feat: improve customer landing page experience
