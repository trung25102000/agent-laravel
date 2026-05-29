# Task: Service Detail Pages And Routing

## Status
completed

## Priority
high

## Objective
Xây dựng trang danh sách dịch vụ và trang chi tiết từng dịch vụ để khách hàng hiểu rõ từng offer trước khi gửi yêu cầu.

## Requirements
- Trang `GET /services` phải hiển thị đầy đủ danh sách dịch vụ từ dữ liệu thật.
- Tạo route chi tiết dịch vụ, ví dụ `GET /services/{serviceOffering:slug}`.
- Mỗi trang chi tiết dịch vụ cần có:
  - vấn đề khách hàng thường gặp
  - giải pháp cung cấp
  - phạm vi công việc
  - công nghệ liên quan nếu phù hợp
  - quy trình làm việc
  - mức giá/thời gian tham khảo
  - CTA gửi yêu cầu/báo giá
- Có section riêng cho các nhu cầu:
  - SEO website
  - fix giao diện
  - làm website/landing page
  - hỗ trợ đồ án
  - task lập trình
- Internal linking tốt giữa homepage, services, pricing, quote form và blog.

## Files Expected
- `seo-web-app/app/Http/Controllers/MarketplaceController.php`
- `seo-web-app/resources/views/marketplace/services.blade.php`
- `seo-web-app/resources/views/marketplace/services/show.blade.php`
- `seo-web-app/resources/views/components/contact-cta.blade.php`
- `seo-web-app/tests/Feature/ServiceDetailPagesTest.php`
- `context/routes-map.md`

## Implementation Notes
- Nếu controller hiện tại đã xử lý `/services`, giữ controller mỏng và chỉ thêm query/view composition cần thiết.
- Copy phải dễ hiểu với khách hàng phổ thông, không quá kỹ thuật.
- Tránh biến trang dịch vụ thành bảng giá khô cứng.

## Done When
- Có list page và detail page hoạt động cho từng dịch vụ publish.
- CTA ở mỗi trang dịch vụ dẫn đúng vào funnel liên hệ hoặc báo giá.
- Route map được cập nhật.

## Test Requirements
- Test `/services` hiển thị dịch vụ seed.
- Test `/services/{slug}` hiển thị đúng nội dung dịch vụ.
- Test unpublished service trả 404 hoặc không public.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: add public service detail pages
