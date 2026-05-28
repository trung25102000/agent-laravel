# Task: Bổ sung image động và animation tăng độ tin tưởng dịch vụ

## Status
completed

## Priority
high

## Objective
Nâng cấp giao diện `seo-web-app` bằng các image động, animation tinh tế và visual trust signals để landing page bắt mắt hơn, tạo cảm giác chuyên nghiệp, dễ gần và tăng niềm tin của khách hàng khi quyết định thuê làm website, landing page hoặc mua source Laravel.

## Requirements
- Bổ sung visual motion cho homepage/landing page nhưng không làm rối trải nghiệm:
  - Hero có mockup website hoặc preview dashboard chuyển động nhẹ.
  - Section quy trình làm việc có animation từng bước.
  - Section template/demo có hover animation rõ ràng.
  - CTA liên hệ có micro-interaction để nổi bật.
  - Trust indicators có icon/visual động nhẹ: bảo hành, bàn giao source, hỗ trợ deploy, demo trước khi nhận.
- Dùng animation thân thiện, hiện đại:
  - Fade/slide-in khi scroll.
  - Hover lift cho card.
  - Subtle floating cho mockup/preview.
  - Progress hoặc timeline motion cho quy trình.
  - Không dùng animation nhấp nháy mạnh, gây khó chịu hoặc làm giảm độ tin cậy.
- Bổ sung image/asset phù hợp với dịch vụ:
  - Mockup landing page cho shop nhỏ.
  - Mockup form thu lead.
  - Mockup source Laravel/admin dashboard cho sinh viên.
  - Có thể dùng CSS mockup tự dựng nếu chưa có ảnh thật.
  - Nếu dùng ảnh ngoài, phải lưu nguồn hợp lệ hoặc dùng asset tự tạo để tránh rủi ro bản quyền.
- Tăng độ tin tưởng bằng nội dung và visual:
  - Badge “Demo trước khi bàn giao”.
  - Badge “Có source + hướng dẫn cài đặt”.
  - Badge “Hỗ trợ chỉnh sửa sau bàn giao”.
  - Badge “Phù hợp chạy quảng cáo/Zalo/Facebook”.
  - Testimonial/demo result nếu có seed data.
- Tối ưu hiệu năng:
  - Không thêm thư viện animation nặng nếu CSS/Alpine/vanilla JS đủ dùng.
  - Tôn trọng `prefers-reduced-motion`.
  - Asset phải lazy-load nếu là ảnh.
  - Không làm layout shift trên mobile.
- Responsive:
  - Mobile vẫn đọc rõ, không che CTA/form.
  - Animation không làm text tràn hoặc overlap.
  - Cards/hero mockup có kích thước ổn định.
- Accessibility:
  - Animation không bắt buộc để hiểu nội dung.
  - Có `alt` phù hợp nếu dùng ảnh thật.
  - Motion giảm hoặc tắt khi user bật reduced motion.

## Files Expected
- `/seo-web-app/resources/views/marketplace/home.blade.php`
- `/seo-web-app/resources/views/marketplace/services.blade.php`
- `/seo-web-app/resources/views/marketplace/templates/index.blade.php`
- `/seo-web-app/resources/views/components/template-card.blade.php`
- `/seo-web-app/resources/views/components/contact-cta.blade.php`
- `/seo-web-app/resources/css/app.css`
- `/seo-web-app/resources/js/app.js`
- `/seo-web-app/public/images/` hoặc `/seo-web-app/resources/images/` nếu cần thêm asset
- `/seo-web-app/tests/Feature/AnimatedTrustVisualsTest.php`
- `/seo-web-app/README.md` nếu có thêm ghi chú asset/build

## Implementation Notes
- Ưu tiên CSS animation nhẹ thay vì thêm dependency:
  - `@keyframes float`
  - `@keyframes fade-up`
  - `transition-transform`
  - `transition-shadow`
  - `opacity/transform` cho scroll reveal.
- Nếu cần scroll reveal:
  - Dùng vanilla JS với `IntersectionObserver`.
  - Gắn class kiểu `data-reveal`.
  - Khi JS tắt, nội dung vẫn hiển thị bình thường.
- Với `prefers-reduced-motion`, tắt hoặc giảm animation:
  - `animation: none`
  - `transition-duration: 0.01ms`
- Không đặt UI marketing vào dạng card lồng card.
- Không dùng quá nhiều gradient/orb trang trí; animation phải phục vụ việc hiểu dịch vụ và tăng niềm tin.
- Copy nên hướng đến 3 nhóm khách hàng:
  - Chủ shop nhỏ/lẻ.
  - Cá nhân kinh doanh online.
  - Sinh viên cần đồ án/source Laravel.
- Các visual mockup nên thể hiện sản phẩm thật:
  - Trang bán hàng.
  - Landing page form lead.
  - Admin/source Laravel/demo project.
- Kiểm tra bằng browser screenshot sau khi build để đảm bảo animation/visual không gây overlap.

## Done When
- Homepage có hero visual động hoặc mockup chuyển động nhẹ, nhìn chuyên nghiệp hơn bản hiện tại.
- Các section quan trọng có animation tinh tế khi hover/scroll.
- Có ít nhất 4 trust badges hoặc trust cards được trình bày rõ ràng.
- CTA liên hệ nổi bật hơn và có micro-interaction.
- Mobile không bị overlap, không tràn text, không mất CTA.
- Reduced motion được hỗ trợ.
- Không có asset nặng hoặc ảnh không rõ nguồn.
- Browser smoke test pass cho homepage, services, templates và contact CTA.

## Test Requirements
- Feature test xác nhận homepage render các trust badges chính.
- Feature test xác nhận không còn copy mặc định Laravel trên UI public liên quan task.
- Nếu có JS/CSS reveal, test hoặc kiểm tra snapshot HTML có marker/class cần thiết.
- Chạy trong `/seo-web-app`:
  - `composer dump-autoload`
  - `php artisan test`
  - `npm run build`
- Browser smoke test:
  - Mở `/`
  - Kiểm tra hero visual hiển thị.
  - Kiểm tra CTA liên hệ không bị che trên mobile width.
  - Kiểm tra console không có lỗi JS nghiêm trọng.

## Suggested Git Commit Message
- feat: add animated trust visuals to seo web landing page
