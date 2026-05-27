# Web Template Studio

Laravel 13 app for selling website templates, landing pages, Laravel source code, custom web services, and graduation project packages. The previous AI video generator module remains available as a legacy workspace.

## Stack

- Laravel 13
- PHP 8.4 locally, compatible with PHP 8.5 after runtime upgrade
- SQLite local by default; MySQL/PostgreSQL can be configured in `.env`
- Redis queue target for video jobs
- Blade + Vite
- Local storage by default, S3-ready config
- Marketplace modules for templates, pricing, orders, quote leads, graduation project requests, contacts, blog SEO, source code products, demo projects, attachments, FAQ
- FFmpeg render provider for legacy real MP4 output

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan test
```

Install FFmpeg before enabling the real render provider:

```bash
brew install ffmpeg
# or on Ubuntu/Debian:
sudo apt-get update && sudo apt-get install -y ffmpeg
```

## Core Routes

- `GET /`
- `GET /services`
- `GET /templates`
- `GET /templates/{slug}`
- `GET /pricing/shop`
- `GET /pricing/landing-page`
- `GET /pricing/graduation-project`
- `GET /source-code`
- `GET /blog`
- `POST /orders`
- `POST /quote-requests`
- `POST /graduation-project-requests`
- `POST /contact-messages`
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
- `GET /admin/marketplace/*`

## Marketplace Admin Seed

Seed demo data and admin user:

```bash
php artisan db:seed
```

Default admin:

- Email: `admin@example.com`
- Password: `password`

API routes:

- `POST /api/video-projects`
- `GET /api/video-projects/{videoProject}/status`
- `GET /api/video-projects/{videoProject}/result`

## Mock Pipeline

The default MVP pipeline uses mock providers:

- Script: `ScriptGeneratorInterface` -> `MockScriptGenerator`
- Voice: `TextToSpeechInterface` -> `MockTextToSpeechProvider`
- Media assets: `MediaAssetSelectionService`
- Render: `RenderProviderInterface` -> `MockRenderProvider`

The mock render writes a placeholder output file. Real FFmpeg rendering can replace `RenderProviderInterface` without changing controllers or jobs.

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

The FFmpeg provider creates valid fallback scene images, audible AAC fallback audio, SRT subtitles, and a final H.264/AAC MP4 when real AI media/TTS files are not configured yet. Output is stored under `storage/app/private/videos/video-projects/{id}/output.mp4` for the local disk and is accessed through the protected preview/download routes. Render metadata records `has_audio`, `audio_codec`, `audio_duration_seconds`, and detected volume when probing succeeds.

## Demo Video

Create or replace a local xianxia review demo project with scene-specific character PNG assets and generated audible WAV narration:

```bash
php artisan demo:xianxia-review --email=demo@example.com --password=password
```

To replace an existing demo project while keeping its preview URL:

```bash
php artisan demo:xianxia-review --project-id=6
```

Store a reference URL for the visual direction without copying source frames:

```bash
php artisan demo:xianxia-review --project-id=6 --reference-url="https://www.youtube.com/watch?v=5W-8VZa1jpw"
```

Use `--skip-render` in tests or local setup when FFmpeg is not available. Rendering still requires `ffmpeg` and `ffprobe`, either installed globally or passed with `--ffmpeg` and `--ffprobe`.

## Queue

`RenderVideoJob` targets the configured video queue:

```bash
php artisan queue:work redis --queue=video,default --tries=2 --timeout=1200
```

## Security Notes

- Project access uses `VideoProjectPolicy`.
- Admin uses gate `access-admin`.
- Login is throttled in `LoginRequest`.
- API routes use `throttle:api`.
- API responses do not expose internal storage paths; use preview/download URLs.
