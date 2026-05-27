# AI Video Generator

Laravel 13 app for generating short-form AI video projects.

## Stack

- Laravel 13
- PHP 8.4 locally, compatible with PHP 8.5 after runtime upgrade
- SQLite local by default; MySQL/PostgreSQL can be configured in `.env`
- Redis queue target for video jobs
- Blade + Vite
- Local storage by default, S3-ready config

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan test
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
- `GET /video-projects/{videoProject}/download`
- `GET /admin`

API routes:

- `POST /api/video-projects`
- `GET /api/video-projects/{videoProject}/status`
- `GET /api/video-projects/{videoProject}/result`

## Mock Pipeline

The current MVP pipeline uses mock providers:

- Script: `ScriptGeneratorInterface` -> `MockScriptGenerator`
- Voice: `TextToSpeechInterface` -> `MockTextToSpeechProvider`
- Media assets: `MediaAssetSelectionService`
- Render: `RenderProviderInterface` -> `MockRenderProvider`

The mock render writes a placeholder output file. Real FFmpeg rendering can replace `RenderProviderInterface` without changing controllers or jobs.

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
