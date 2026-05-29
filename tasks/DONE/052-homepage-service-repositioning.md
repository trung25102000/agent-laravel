# Task: Homepage Service Repositioning

## Status
completed

## Priority
high

## Objective
Thiết kế lại homepage để dịch vụ là trọng tâm chính của chuyển đổi, thể hiện rõ web, code, app, SEO và hỗ trợ kỹ thuật, đồng thời vẫn tận dụng được template/source/demo như trust asset phụ trợ.

## Requirements
- Hero phải nêu rõ offer tổng quát:
  - làm website
  - sửa web
  - hỗ trợ SEO
  - hỗ trợ đồ án
  - nhận task code nhỏ
- Bổ sung hoặc làm rõ các section:
  - vấn đề khách hàng thường gặp
  - giải pháp
  - danh sách dịch vụ
  - quy trình làm việc
  - dự án đã làm
  - feedback
  - CTA tư vấn nhanh
- Giảm cảm giác “catalog template” ở homepage nếu đang lấn át message dịch vụ.
- CTA chính/phụ phải dẫn đúng tới quote, contact, services, portfolio.
- Giữ visual hiện đại, chuyên nghiệp, tạo cảm giác tin tưởng như user mô tả.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/views/components/contact-cta.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/HomepageServicePositioningTest.php`

## Implementation Notes
- Kế thừa phần motion/reveal tốt đã có, nhưng chỉnh narrative theo service-first.
- Không biến trang thành danh sách card đồng dạng.
- Ưu tiên conversion copy rõ ràng hơn slogan chung chung.

## Done When
- Homepage đọc vào là hiểu ngay đây là website cung cấp dịch vụ công nghệ.
- Các section user yêu cầu đều hiện diện ở mức hợp lý.
- Tỷ trọng template/source chỉ còn là phần hỗ trợ trust hoặc upsell.

## Test Requirements
- Test homepage có các section dịch vụ, quy trình, portfolio, feedback, CTA.
- Test không còn phụ thuộc headline cũ thiên về template-only nếu không còn đúng.
- Chạy trong `seo-web-app`:
  - `php artisan test`
  - `npm run build`

## Suggested Git Commit Message
- feat: reposition homepage around service offerings
