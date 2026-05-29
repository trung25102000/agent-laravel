# Routes Map

## SEO Web App (`seo-web-app/`)

Public:

- `GET /` homepage service-first landing page cho Web Template Studio
- `GET /services` trang danh sách dịch vụ dùng dữ liệu publish từ `service_offerings`
- `GET /services/{serviceOffering:slug}` trang chi tiết dịch vụ với problem/solution/scope/technology/process/CTA
- `GET /templates` gallery template/demo đóng vai trò trust asset và điểm vào cho khách muốn xem mẫu trước
- `GET /templates/{websiteTemplate:slug}` chi tiết template/demo
- `GET /pricing/{type}` bảng giá tham khảo theo nhóm use case/service type; hiện hỗ trợ `shop`, `landing-page`, `ui-fix`, `seo`, `graduation-project`, `coding-task`
- `GET /portfolio` danh sách portfolio/case studies public
- `GET /portfolio/{demoProject:slug}` chi tiết case study
- `GET /source-code` sản phẩm source code Laravel và đồ án
- `GET /source-code/{sourceCodeProduct:slug}` chi tiết source code
- `GET /blog` blog nội dung SEO, website và hỗ trợ kỹ thuật; hỗ trợ lọc nhẹ theo trụ cột bằng query `?pillar=...`
- `GET /blog/{blogPost:slug}` chi tiết bài viết
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
- `GET /admin` dashboard lead/services hiện còn mang naming marketplace
- `GET|POST /admin/marketplace/categories`
- `GET|POST /admin/marketplace/templates`
- `GET|POST /admin/marketplace/services`
- `PATCH /admin/marketplace/services/{serviceOffering}`
- `GET|POST /admin/marketplace/packages`
- `GET /admin/marketplace/orders`
- `PATCH /admin/marketplace/orders/{orderRequest}`
- `GET /admin/marketplace/customers`
- `PATCH /admin/marketplace/customers/{customer}`
- `GET /admin/marketplace/contacts`
- `PATCH /admin/marketplace/contacts/{contactMessage}`
- `GET /admin/marketplace/quotes`
- `PATCH /admin/marketplace/quotes/{quoteRequest}`
- `GET /admin/marketplace/graduation-requests`
- `PATCH /admin/marketplace/graduation-requests/{graduationProjectRequest}`
- `GET|POST /admin/marketplace/blog-posts`
- `GET|POST /admin/marketplace/source-code-products`
- `GET /admin/marketplace/demo-projects`
- `POST /admin/marketplace/demo-projects`
- `PATCH /admin/marketplace/demo-projects/{demoProject}`
- `GET|POST /admin/marketplace/testimonials`
- `PATCH /admin/marketplace/testimonials/{testimonial}`
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
