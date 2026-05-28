# Routes Map

## SEO Web App (`seo-web-app/`)

Public:

- `GET /` landing page Web Template Studio
- `GET /services`
- `GET /templates`
- `GET /templates/{websiteTemplate:slug}`
- `GET /pricing/{type}` với `shop`, `landing-page`, `graduation-project`
- `GET /source-code`
- `GET /source-code/{sourceCodeProduct:slug}`
- `GET /blog`
- `GET /blog/{blogPost:slug}`
- `GET /sitemap.xml`
- `GET /robots.txt`

Public form routes:

- `POST /orders`
- `POST /quote-requests`
- `POST /graduation-project-requests`
- `POST /contact-messages`

Auth/admin:

- `GET|POST /login`
- `GET|POST /register`
- `POST /logout`
- `GET /admin`
- `GET|POST /admin/marketplace/categories`
- `GET|POST /admin/marketplace/templates`
- `GET|POST /admin/marketplace/packages`
- `GET /admin/marketplace/orders`
- `PATCH /admin/marketplace/orders/{orderRequest}`
- `GET /admin/marketplace/customers`
- `GET /admin/marketplace/contacts`
- `GET /admin/marketplace/quotes`
- `GET /admin/marketplace/graduation-requests`
- `GET|POST /admin/marketplace/blog-posts`
- `GET|POST /admin/marketplace/source-code-products`
- `GET /admin/marketplace/demo-projects`
- `GET /admin/marketplace/faqs`

## Video Generator App (`video-generator-app/`)

Web:

- `GET /` AI Video Generator landing page
- `GET|POST /login`
- `GET|POST /register`
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

API:

- `POST /api/video-projects`
- `GET /api/video-projects/{videoProject}/status`
- `GET /api/video-projects/{videoProject}/result`
