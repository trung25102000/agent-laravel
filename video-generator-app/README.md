# AI Video Generator

Laravel app độc lập cho nền tảng tạo short-form video bằng AI.

## Stack

- Laravel 13
- PHP 8.4 local, tương thích PHP 8.5 khi runtime nâng cấp
- SQLite local mặc định; MySQL/PostgreSQL có thể cấu hình qua `.env`
- Redis queue target cho video jobs
- Blade + Vite
- Local storage mặc định, S3-ready config
- FFmpeg render provider cho MP4 thật

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
npm install
npm run build
php artisan serve --host=127.0.0.1 --port=8020
```

## Core Routes

- `GET /register`, `POST /register`
- `GET /login`, `POST /login`
- `POST /logout`
- `GET /dashboard`
- `GET /video-projects/create`
- `POST /video-projects`
- `GET /video-projects/{videoProject}`
- `GET /video-projects/{videoProject}/status`
- `GET /video-projects/{videoProject}/preview`
- `GET /video-projects/{videoProject}/stream`
- `GET /video-projects/{videoProject}/download`
- `GET /admin`

API routes:

- `POST /api/video-projects`
- `GET /api/video-projects/{videoProject}/status`
- `GET /api/video-projects/{videoProject}/result`

## Real FFmpeg Rendering

Set these variables to render real 9:16 MP4 files:

```env
VIDEO_RENDER_PROVIDER=ffmpeg
FFMPEG_BINARY=ffmpeg
FFPROBE_BINARY=ffprobe
VIDEO_RENDER_MIN_DURATION=180
VIDEO_RENDER_MAX_DURATION=240
VIDEO_DEFAULT_WIDTH=1080
VIDEO_DEFAULT_HEIGHT=1920
VIDEO_DEFAULT_FPS=30
VIDEO_RENDER_PRESET=veryfast
```

## Demo Video

```bash
php artisan demo:xianxia-review --email=demo@example.com --password=password
php artisan demo:xianxia-review --project-id=6
```

## Queue

```bash
php artisan queue:work redis --queue=video,default --tries=2 --timeout=1200
```

## Validation

```bash
composer dump-autoload
php artisan migrate:fresh --seed
php artisan test
npm run build
```
