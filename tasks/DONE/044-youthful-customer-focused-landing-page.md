# Task: Xây dựng landing page trẻ trung, năng động, thân thiện cho khách hàng

## Status
completed

## Priority
high

## Objective
Thiết kế lại giao diện public của dự án SEO-web theo hướng landing page thuyết phục khách hàng thuê làm website, tạo ấn tượng chuyên nghiệp ngay từ màn hình đầu tiên và giúp khách dễ gửi yêu cầu tư vấn.

## Requirements
- Giao diện phải trẻ trung, năng động, thân thiện và dễ gần.
- Trang chủ phải hoạt động như một landing page bán dịch vụ, không chỉ là danh sách chức năng.
- First viewport cần làm rõ:
  - Dự án/sản phẩm đang cung cấp dịch vụ làm website, landing page, source Laravel, đồ án tốt nghiệp.
  - Nhóm khách hàng chính: chủ shop nhỏ, cá nhân kinh doanh online, sinh viên.
  - Lợi ích rõ ràng: triển khai nhanh, có demo, có chỉnh sửa, có hỗ trợ cài đặt/chạy project.
  - CTA chính: nhận tư vấn/báo giá.
  - CTA phụ: xem mẫu web hoặc xem gói giá.
- Nội dung landing page cần có các section:
  - Hero section có headline mạnh, subcopy dễ hiểu, CTA rõ.
  - Social proof hoặc trust signals: số mẫu, thời gian triển khai, hỗ trợ, demo trước khi mua.
  - Dịch vụ chính: website shop nhỏ, landing page quảng cáo, source Laravel/đồ án.
  - Quy trình làm việc: nhận yêu cầu, tư vấn, chọn mẫu/gói, triển khai, bàn giao.
  - Mẫu web nổi bật hoặc demo project.
  - Gói giá nổi bật theo 3 nhóm khách hàng.
  - FAQ cho shop nhỏ và sinh viên.
  - Contact CTA cuối trang có Zalo/Facebook/Email.
- UI phải tối ưu mobile trước, không bị tràn chữ hoặc overlap.
- Không dùng copy chung chung kiểu template mặc định.
- Không tạo giao diện marketing rỗng; form liên hệ/báo giá phải dùng được.
- Màu sắc nên sáng, gần gũi, có điểm nhấn rõ nhưng không một màu đơn điệu.
- Các nút CTA phải có text dễ hiểu với customer Việt Nam.

## Files Expected
- Nếu đã tách source:
  - `/seo-web-app/resources/views/marketplace/home.blade.php`
  - `/seo-web-app/resources/views/layouts/app.blade.php`
  - `/seo-web-app/resources/views/components/contact-cta.blade.php`
  - `/seo-web-app/resources/views/components/template-card.blade.php`
  - `/seo-web-app/resources/css/app.css`
  - `/seo-web-app/tests/Feature/*Landing*Test.php`
- Nếu chưa tách source, triển khai tạm trong:
  - `/video-generator-app/resources/views/marketplace/home.blade.php`
  - `/video-generator-app/resources/views/layouts/app.blade.php`
  - `/video-generator-app/resources/views/components/contact-cta.blade.php`
  - `/video-generator-app/resources/views/components/template-card.blade.php`
  - `/video-generator-app/resources/css/app.css`
  - `/video-generator-app/tests/Feature/*Landing*Test.php`

## Implementation Notes
- Ưu tiên Blade + Tailwind theo stack hiện tại.
- Không đưa UI card lồng card quá nhiều; section nên rõ, thoáng và dễ scan.
- Hero không được giống trang mặc định Laravel.
- Copywriting cần hướng đến chuyển đổi:
  - "Nhận báo giá trong ngày"
  - "Xem demo trước khi đặt"
  - "Có source, database, báo cáo, hướng dẫn"
  - "Phù hợp shop nhỏ và người mới kinh doanh online"
- Nên dùng dữ liệu động từ `WebsiteTemplate`, `PricingPackage`, `FaqItem` nếu có, và fallback đẹp nếu chưa có data.
- Cần đảm bảo khách chưa đăng nhập vẫn xem được đầy đủ landing page và gửi form.
- Nếu cần assets minh họa, dùng CSS/gradient nhẹ hoặc ảnh thật/generate sau, nhưng tránh hình quá chung chung.

## Done When
- Khách mở `/` thấy ngay đây là website bán dịch vụ làm web/source Laravel, không nhầm với Laravel default hoặc AI video app.
- Landing page có đầy đủ hero, dịch vụ, quy trình, demo/template, gói giá, FAQ, CTA liên hệ.
- Form báo giá hiển thị rõ và submit được.
- Giao diện đẹp trên mobile và desktop.
- Không còn text/copy nào làm khách thấy đây là app demo nội bộ.

## Test Requirements
- Feature test guest xem homepage:
  - thấy headline dự án/dịch vụ.
  - thấy CTA nhận tư vấn/báo giá.
  - thấy 3 nhóm khách hàng hoặc 3 nhóm dịch vụ.
  - không thấy text mặc định Laravel.
- Feature test form báo giá submit thành công.
- Chạy:
  - `composer dump-autoload`
  - `php artisan test`
  - `npm run build`
- Browser smoke test `/` ở viewport desktop và mobile.

## Suggested Git Commit Message
- feat: improve customer-focused seo web landing page
