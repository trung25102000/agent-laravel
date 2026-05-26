# Task: Project Foundation

## Status
pending

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
- Đảm bảo app chạy được với PHP 8.3+ và Laravel 11 hoặc 12

## Files Expected
- `.env.example`
- `config/app.php`
- `config/filesystems.php`
- `config/queue.php`
- `config/services.php`
- `config/video_pipeline.php` hoặc file config tương đương
- `storage/app/videos/`
- `storage/app/audio/`
- `storage/app/subtitles/`
- `storage/app/assets/`
- `storage/app/previews/`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên config rõ ràng, không hard-code path trong service
- Nếu cần, tạo helper config theo `config('video_pipeline.*')`
- Chuẩn bị queue driver mặc định dễ dùng cho local như database
- Nếu project mới chưa có setup queue table, ghi rõ để task sau có thể tạo migration phù hợp

## Done When
- Cấu hình nền tảng cho app và pipeline đã sẵn sàng
- Storage path cần thiết đã được chuẩn hóa
- Queue config hoạt động theo hướng MVP
- Test pass
- Không vi phạm rules

## Test Requirements
- Có test smoke hoặc config assertion nếu phù hợp
- `php artisan test` phải pass
