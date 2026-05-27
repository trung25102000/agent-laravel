# AI Video Generator Laravel Agent Repo

Repo này gồm hai phần:

- Root repo: bộ agent workflow, rules, context, memory, prompts, và task files.
- `video-generator-app/`: source Laravel 13 của nền tảng tạo video AI.

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

## Application Flow

1. User đăng ký hoặc đăng nhập.
2. User tạo `VideoProject` draft từ keyword, content brief, tone, duration, platform, language.
3. Mock pipeline có thể tạo script, scenes, media assets, voice-over, subtitle, và render output placeholder.
4. User xem status, preview, và download output qua route được authorize.
5. Admin xem users/projects và filter project theo status tại `/admin`.

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

Test suite hiện cover auth, dashboard, project CRUD draft, script/scene/media/voice/subtitle/render mock services, API, notification, security, and end-to-end mock pipeline.
