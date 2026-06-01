# Task: Homepage UX Simplification And Conversion Refactor

## Status
completed

## Priority
high

## Objective

Refactor lại Home Page của `seo-web-app` theo kết quả audit mới để giảm information overload, làm rõ dịch vụ chính trong 5-15 giây đầu, và tăng conversion cho khách hàng mới.

## Requirements

- Không giữ tư duy “nhiều section là tốt”.
- Ưu tiên:
  - rõ ràng
  - dễ hiểu
  - scan nhanh
  - conversion cao
- Home Page phải giúp khách mới hiểu nhanh:
  - website này làm gì
  - dịch vụ chính là gì
  - dành cho ai
  - nên bấm gì tiếp theo
- Giảm trùng lặp thông điệp giữa Hero, trust, CTA, pricing, FAQ và các section giải thích.
- Thiết kế lại structure theo nguyên tắc: “Ít hơn nhưng hiệu quả hơn”.

## Subtasks

- Audit lại implementation hiện tại dựa trên `tasks/home-page-review.md`.
- Dùng `tasks/home-page-improvement-plan.md` làm blueprint triển khai.
- Refactor Hero để giảm số lượng thông điệp, visual state và CTA cạnh tranh.
- Rút gọn hoặc gộp Problems, Solutions và Services theo flow ngắn hơn.
- Xóa hoặc hợp nhất các section gây nhiễu:
  - audience section riêng
  - trust badges section riêng
  - conversion strip riêng nếu không còn cần
  - extended offers nếu làm loãng trọng tâm
- Rút gọn Portfolio thành showcase ngắn hơn nhưng vẫn giữ trust.
- Rút Process xuống bản dễ quét hơn.
- Tối ưu `contact-cta` và cân nhắc giảm ma sát của form.
- Chuyển Pricing/FAQ khỏi Home hoặc rút thành teaser nếu vẫn cần giữ entry point.
- Cập nhật test theo contract mới của Home Page.

## Files Expected

- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/components/contact-cta.blade.php`
- `seo-web-app/resources/views/layouts/app.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`
- `seo-web-app/tests/Feature/ConsultationFunnelTest.php`
- `seo-web-app/tests/Feature/ContactChannelCtaTest.php`
- `tasks/home-page-review.md`
- `tasks/home-page-improvement-plan.md`

## Implementation Notes

- Hai tài liệu sau là nguồn chính để triển khai:
  - `tasks/home-page-review.md`
  - `tasks/home-page-improvement-plan.md`
- Giữ các tài liệu này như artifact audit/plan, không cần move sang `DONE`.
- Cấu trúc mục tiêu nên tiến gần về:
  1. Hero
  2. Pain points
  3. Dịch vụ chính
  4. Why choose us
  5. Portfolio nổi bật
  6. Quy trình làm việc
  7. Feedback
  8. CTA cuối
- Tránh thêm section mới nếu không phục vụ trực tiếp cho việc hiểu nhanh, tạo trust hoặc gửi yêu cầu.

## Done When

- Home Page ngắn hơn, rõ trọng tâm hơn và ít trùng lặp hơn.
- Khách mới có thể hiểu nhanh dịch vụ chính và đối tượng mục tiêu trong 5-15 giây đầu.
- CTA chính rõ hơn, ít cạnh tranh hơn và flow gửi brief/liên hệ ngắn hơn.
- Các section không hỗ trợ conversion trực tiếp đã được rút gọn, gộp hoặc chuyển khỏi Home.
- Test pass và build asset pass.

## Test Requirements

- `composer dump-autoload`
- `php artisan migrate`
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message

- feat: simplify homepage ux and tighten conversion flow
