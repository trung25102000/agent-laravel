# Agent Laravel Workspace

Repo này có root control plane cho autonomous Laravel agents và hai Laravel app độc lập:

- `seo-web-app/`: Web Template Studio, website bán template, landing page, source Laravel, demo project và dịch vụ làm web.
- `video-generator-app/`: AI Video Generator, nền tảng tạo video dọc 9:16 với script, scenes, voice, subtitle và FFmpeg render.

Root repo giữ `.agents/AGENTS.md`, `.agents/rules/`, `.agents/context/`, `.agents/memory/`, `.codex/prompts/`, `.agents/agents/`, `tasks/`.

## Chạy SEO Web

```bash
cd seo-web-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed --force
npm install
npm run build
php artisan serve --host=127.0.0.1 --port=8010
```

Admin seed:

- Email: `admin@example.com`
- Password: `password`

## Chạy Video Generator

```bash
cd video-generator-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed --force
npm install
npm run build
php artisan serve --host=127.0.0.1 --port=8020
```

## Validation

SEO-web:

```bash
cd seo-web-app
composer dump-autoload
php artisan migrate:fresh --seed --force
php artisan test
npm run build
```

Video generator:

```bash
cd video-generator-app
composer dump-autoload
php artisan migrate:fresh --seed --force
php artisan test
npm run build
```

## Notes

- Mỗi app có `.env.example`, database local, routes, tests và build asset riêng.
- Không commit `.env`, `vendor`, `node_modules`, `public/build`, storage private hoặc log files.
