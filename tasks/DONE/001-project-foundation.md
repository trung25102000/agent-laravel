# Task: Project Foundation

## Status
completed

## Priority
high

## Objective
Khởi tạo nền tảng Laravel cho dự án tạo video tự động, bao gồm cấu trúc app, config môi trường, storage, queue, và các thành phần cơ bản để các module sau có thể phát triển ổn định.

## Requirements
- Thiết lập cấu trúc project theo rules trong repo
- Cập nhật `.env.example` với các biến cần cho app, queue, storage, AI mock provider, TTS mock provider, render mock provider
- Cấu hình app name, timezone, locale, filesystem, queue connection
- Tạo hoặc chuẩn hóa các thư mục storage cho video, audio, subtitle, assets, preview, logs nghiệp vụ nếu cần
- Chuẩn bị config file riêng cho pipeline video nếu hợp lý
- Tạo thư mục ứng dụng `video-generator-app/` ở root repo và bootstrap source Laravel bên trong thư mục đó
- Không đặt source Laravel trực tiếp vào root repo agent
- Khởi tạo hoặc chuẩn hóa app theo Laravel 13.x mới nhất và PHP 8.5 mới nhất
- `composer.json` phải dùng `laravel/framework:^13.0` và `php:^8.5`, trừ khi có blocker package/runtime được ghi rõ trong `context/decisions.md`
- Tôn trọng skeleton Laravel 13 hiện đại, không tự thêm cấu trúc legacy nếu framework không dùng

## Files Expected
- `video-generator-app/composer.json`
- `video-generator-app/.env.example`
- `video-generator-app/config/app.php`
- `video-generator-app/config/filesystems.php`
- `video-generator-app/config/queue.php`
- `video-generator-app/config/services.php`
- `video-generator-app/config/video_pipeline.php` hoặc file config tương đương
- `video-generator-app/storage/app/videos/`
- `video-generator-app/storage/app/audio/`
- `video-generator-app/storage/app/subtitles/`
- `video-generator-app/storage/app/assets/`
- `video-generator-app/storage/app/previews/`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên config rõ ràng, không hard-code path trong service
- Nếu cần, tạo helper config theo `config('video_pipeline.*')`
- Chuẩn bị queue driver mặc định dễ dùng cho local như database
- Nếu project mới chưa có setup queue table, ghi rõ để task sau có thể tạo migration phù hợp
- Dùng Vite nếu có asset frontend; không dùng Laravel Mix
- Nếu cần API route trong skeleton mới, bật theo cơ chế chính thức thay vì giả định file `routes/api.php` đã tồn tại
- Các lệnh `composer`, `php artisan`, `npm`, test, migrate phải chạy với working directory là `video-generator-app/`

## Done When
- Cấu hình nền tảng cho app và pipeline đã sẵn sàng
- Storage path cần thiết đã được chuẩn hóa
- Queue config hoạt động theo hướng MVP
- Test pass
- Không vi phạm rules

## Test Requirements
- Có test smoke hoặc config assertion nếu phù hợp
- `php artisan test` phải pass
