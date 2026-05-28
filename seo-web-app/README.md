# Web Template Studio

Laravel app độc lập cho website bán template, landing page, source code Laravel, demo project và dịch vụ làm web theo yêu cầu.

## Stack

- Laravel 13
- PHP 8.4 local, tương thích PHP 8.5 khi runtime nâng cấp
- SQLite local mặc định, có thể đổi sang MySQL/PostgreSQL qua `.env`
- Blade + TailwindCSS + Vite
- Auth/admin tối giản bằng `users.is_admin`

## Setup Local

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
npm install
npm run build
php artisan serve --host=127.0.0.1 --port=8010
```

Admin seed mặc định:

- Email: `admin@example.com`
- Password: `password`

## Public Routes

- `GET /`
- `GET /services`
- `GET /templates`
- `GET /templates/{slug}`
- `GET /pricing/shop`
- `GET /pricing/landing-page`
- `GET /pricing/graduation-project`
- `GET /source-code`
- `GET /source-code/{slug}`
- `GET /blog`
- `GET /blog/{slug}`
- `GET /sitemap.xml`
- `GET /robots.txt`

Form public:

- `POST /orders`
- `POST /quote-requests`
- `POST /graduation-project-requests`
- `POST /contact-messages`

Admin:

- `GET /admin`
- `GET|POST /admin/marketplace/templates`
- `GET|POST /admin/marketplace/packages`
- `GET /admin/marketplace/orders`
- `GET /admin/marketplace/quotes`
- `GET /admin/marketplace/graduation-requests`
- `GET /admin/marketplace/customers`
- `GET|POST /admin/marketplace/blog-posts`
- `GET|POST /admin/marketplace/source-code-products`

## Environment

```env
APP_NAME="Web Template Studio"
DB_CONNECTION=sqlite
DB_DATABASE=database/seo_web.sqlite
CONTACT_ZALO_URL=https://zalo.me/0000000000
CONTACT_FACEBOOK_URL=https://facebook.com
CONTACT_EMAIL=hello@example.com
MAIL_MAILER=log
```

## Validation

```bash
composer dump-autoload
php artisan migrate:fresh --seed
php artisan test
npm run build
```
