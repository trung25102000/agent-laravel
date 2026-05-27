# Web Template Studio Laravel Agent Repo

Repo này gồm hai phần:

- Root repo: bộ agent workflow, rules, context, memory, prompts, và task files.
- `video-generator-app/`: source Laravel 13 của marketplace bán template/dịch vụ làm web/source Laravel, đồng thời giữ module AI video legacy.

## Local Setup

```bash
cd video-generator-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan test
```

Môi trường hiện tại dùng PHP 8.4.7, nên `composer.json` đang đặt `php:^8.4`. Khi runtime PHP 8.5 sẵn sàng, đổi lại `php:^8.5`, chạy `composer update --lock`, rồi chạy lại test.

## Marketplace Flow

1. Khách xem landing page, dịch vụ, template, source Laravel, blog SEO.
2. Khách lọc template, xem chi tiết/demo, chọn gói giá.
3. Khách gửi yêu cầu mua, báo giá, liên hệ hoặc đặt làm đồ án tốt nghiệp.
4. Admin xem dashboard `/admin`, quản lý template, gói dịch vụ, lead, đơn hàng, khách hàng, blog, source code, demo, FAQ.
5. Module video AI cũ vẫn dùng được qua `/dashboard` và `/video-projects/*`.

## Mock Providers

Các provider hiện là mock để MVP chạy thật trong local mà chưa cần API key:

- `MockScriptGenerator`: tạo script text từ input project.
- `MockTextToSpeechProvider`: tạo file text giả lập voice-over.
- `MediaAssetSelectionService`: tạo placeholder asset từ visual prompt.
- `MockRenderProvider`: tạo output text file thay cho MP4 thật.

Các provider đã được tách interface để thay bằng OpenAI, Image AI, TTS thật, và FFmpeg ở các phase sau.

## Queue And Render

Render hiện có `RenderVideoJob` queued và chạy queue `video` theo `config/video_pipeline.php`.

Local queue command:

```bash
php artisan queue:work redis --queue=video,default --tries=2 --timeout=1200
```

Trong test, queue không cần Redis vì flow dùng service/job trực tiếp hoặc `QUEUE_CONNECTION=sync`.

## Validation

```bash
cd video-generator-app
composer dump-autoload
php artisan migrate
php artisan test
```

Test suite hiện cover auth, marketplace public pages/forms/admin/SEO, video project legacy, script/scene/media/voice/subtitle/render mock services, API, notification, security, and end-to-end mock pipeline.
