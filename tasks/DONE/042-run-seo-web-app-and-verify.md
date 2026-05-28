# Task: Khởi chạy seo-web-app và verify giao diện

## Status
completed

## Priority
high

## Objective
Sau khi tách source, khởi chạy dự án SEO-web độc lập và xác nhận website hoạt động trên browser.

## Requirements
- Chạy server từ `/seo-web-app`, không chạy từ `/video-generator-app`.
- Dùng port riêng, ưu tiên `8010`; nếu bận thì chọn port khác và ghi rõ.
- Chạy migration/seed trước khi mở server.
- Mở browser kiểm tra:
  - `/`
  - `/services`
  - `/templates`
  - `/pricing/shop`
  - `/source-code`
  - `/blog`
  - `/login`
- Kiểm tra CTA form báo giá hiển thị.
- Kiểm tra `sitemap.xml` và `robots.txt`.
- Nếu server cần giữ chạy cho user, không dừng process khi kết thúc task.

## Files Expected
- Không bắt buộc sửa file nếu app đã chạy.
- Có thể cập nhật `/memory/progress.md` với URL đang chạy.

## Implementation Notes
- Lệnh gợi ý:
  - `cd seo-web-app`
  - `php artisan migrate --force`
  - `php artisan db:seed --force`
  - `php artisan serve --host=127.0.0.1 --port=8010`
- Nếu đang ở giai đoạn trước khi tách source, được phép chạy tạm SEO-web từ `video-generator-app` nhưng phải ghi rõ đây là server tạm.

## Done When
- User nhận được URL SEO-web đang chạy.
- Browser smoke test xác nhận homepage render đúng.
- Không còn lỗi 500/asset missing trên các page chính.

## Test Requirements
- `php artisan test` pass trong `/seo-web-app`.
- Browser smoke test các route public chính.

## Suggested Git Commit Message
- chore: verify standalone seo web local server
