# Platform Version Rules

## Mục Tiêu

- Mọi task mới phải ưu tiên Laravel 13.x mới nhất và PHP 8.5 mới nhất.
- Khi khởi tạo project mới, mặc định dùng `laravel/framework:^13.0` và `php:^8.5`.
- Laravel 13 hỗ trợ PHP 8.3 - 8.5; chỉ dùng PHP 8.4 hoặc 8.3 khi package, runtime, hoặc hosting bắt buộc và phải ghi lý do vào `context/decisions.md`.

## Composer và Dependency

- Source Laravel của ứng dụng phải nằm trong thư mục riêng `video-generator-app/` ở root repo, trừ khi `context/project-context.md` được cập nhật sang tên thư mục khác.
- Root repo agent không được chứa trực tiếp `composer.json`, `app/`, `routes/`, `config/`, hoặc source Laravel runtime.
- Khi chạy Composer, Artisan, npm, test, migrate, hoặc command framework, phải chạy trong thư mục ứng dụng Laravel.
- Không pin dependency vào version cũ nếu không có lý do rõ ràng.
- Ưu tiên package đã support Laravel 13 và PHP 8.5.
- Trước khi thêm package, kiểm tra package còn maintained, tương thích Laravel 13, và không kéo dependency EOL.
- Nếu cần workaround do package chưa hỗ trợ PHP 8.5, ghi rõ phạm vi và kế hoạch gỡ workaround.

## Laravel 13 Defaults

- Tôn trọng cấu trúc skeleton hiện đại của Laravel 13, bao gồm `bootstrap/app.php` cho cấu hình middleware, exception, routing, schedule nếu framework đang dùng pattern này.
- Không tự tạo lại `app/Http/Kernel.php` hoặc cấu trúc cũ nếu skeleton hiện tại không dùng.
- Với API routes, nếu project mới chưa có `routes/api.php`, dùng cơ chế chính thức của Laravel để bật API routing hoặc khai báo route theo pattern hiện có.
- Dùng Vite cho assets frontend; không dùng Laravel Mix cho code mới.
- Ưu tiên feature chính thức của Laravel 13 khi phù hợp, ví dụ attribute-first APIs, queue routing, JSON:API resources, search/vector APIs, hoặc Laravel AI SDK. Không ép dùng feature mới nếu làm tăng độ phức tạp không cần thiết.

## PHP 8.5 Style

- Dùng strict types cho file PHP mới khi phù hợp với codebase.
- Dùng typed properties, return types, union/intersection types, nullable types, constructor property promotion, `readonly`, enum, attributes, `match`, và null-safe operator khi giúp code rõ ràng hơn.
- Không dùng dynamic properties.
- Không dùng API, package, hoặc polyfill cũ nếu PHP 8.5 đã có giải pháp native rõ ràng.
