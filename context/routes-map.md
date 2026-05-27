# Routes Map

Dùng file này để ghi lại map các route hiện có trong dự án Laravel sau khi Codex hoặc developer đã phân tích codebase.

## Web Routes

- `GET /` landing page marketplace bán template/dịch vụ/source Laravel, có CTA xem mẫu và form báo giá
- `GET /services` trang dịch vụ làm website/landing page/đồ án
- `GET /templates` danh sách template public có search/filter/sort/pagination
- `GET /templates/{websiteTemplate:slug}` chi tiết template, demo URL, pricing, form đặt mua
- `GET /pricing/{type}` trang gói giá theo `shop`, `landing-page`, `graduation-project`
- `GET /source-code` danh sách source Laravel/demo project cho sinh viên
- `GET /source-code/{sourceCodeProduct:slug}` chi tiết source code, file đính kèm, form đặt làm đồ án
- `GET /blog` danh sách blog SEO theo nhóm khách hàng
- `GET /blog/{blogPost:slug}` chi tiết blog SEO
- `GET /sitemap.xml` sitemap XML cơ bản
- `GET /robots.txt` robots public kèm sitemap
- `POST /orders` lưu yêu cầu mua template/dịch vụ, throttle public form
- `POST /quote-requests` lưu lead/yêu cầu báo giá, throttle public form
- `POST /graduation-project-requests` lưu yêu cầu đồ án tốt nghiệp, throttle public form
- `POST /contact-messages` lưu tin nhắn liên hệ, throttle public form
- `GET /login` hiển thị form đăng nhập branded cho AI video workspace, middleware `guest`
- `POST /login` xử lý đăng nhập, middleware `guest`, có rate limit trong `LoginRequest`
- `GET /register` hiển thị form đăng ký branded cho creator workspace, middleware `guest`
- `POST /register` xử lý đăng ký, middleware `guest`
- `POST /logout` đăng xuất, middleware `auth`
- `GET /dashboard` dashboard user cơ bản với empty state và link tạo video, middleware `auth`
- `GET /video-projects/create` form tạo video project, middleware `auth`
- `POST /video-projects` validate bằng `StoreVideoProjectRequest`, lưu video project draft cho owner hiện tại
- `GET /video-projects/{videoProject}` xem chi tiết project với progress/script/scenes/output panel, middleware `auth`, policy `view`
- `GET /video-projects/{videoProject}/status` trả JSON status/progress/error/output, middleware `auth`, policy `view`
- `GET /video-projects/{videoProject}/preview` trang preview output với video player 9:16, metadata, empty/missing/unplayable states, middleware `auth`, policy `view`
- `GET /video-projects/{videoProject}/stream` stream inline MP4 cho `<video src>`, middleware `auth`, policy `view`
- `GET /video-projects/{videoProject}/download` download output qua controller/storage, middleware `auth`, policy `view`

## API Routes

- `POST /api/video-projects` tạo video project draft qua API, middleware `auth`, dùng `Api\StoreVideoProjectRequest`, trả `VideoProjectResource` HTTP 201
- `GET /api/video-projects/{videoProject}` lấy chi tiết project
- `GET /api/video-projects/{videoProject}/status` lấy trạng thái và progress, middleware `auth`, policy `view`
- `GET /api/video-projects/{videoProject}/result` lấy metadata video output khi completed, middleware `auth`, policy `view`
- `POST /api/video-projects/{videoProject}/generate-script` trigger generation nếu cần tách bước ở nội bộ
- `POST /api/video-projects/{videoProject}/render` trigger render nếu cần ở nội bộ/admin

## Auth / Admin / Internal Routes

- `GET /admin` dashboard admin marketplace, thống kê template/order/lead/contact và vẫn hiển thị video projects cũ, middleware `auth`, gate `access-admin`
- `GET /admin/video-projects` dashboard admin video projects legacy
- `GET /admin/marketplace/categories` quản lý danh mục template
- `GET|POST /admin/marketplace/templates` quản lý template website
- `GET|POST /admin/marketplace/packages` quản lý gói dịch vụ
- `GET /admin/marketplace/orders`, `PATCH /admin/marketplace/orders/{orderRequest}` quản lý đơn hàng/yêu cầu mua
- `GET /admin/marketplace/customers` xem khách hàng và lịch sử request count
- `GET /admin/marketplace/contacts` quản lý contact messages
- `GET /admin/marketplace/quotes` quản lý lead/yêu cầu báo giá
- `GET /admin/marketplace/graduation-requests` quản lý yêu cầu đồ án
- `GET|POST /admin/marketplace/blog-posts` quản lý blog SEO
- `GET|POST /admin/marketplace/source-code-products` quản lý source Laravel
- `GET /admin/marketplace/demo-projects` quản lý demo project
- `GET /admin/marketplace/faqs` quản lý FAQ
- `POST /internal/pipeline/video-projects/{videoProject}/start` route nội bộ nếu cần orchestration tách khỏi UI
- `POST /internal/pipeline/video-projects/{videoProject}/retry` route nội bộ hoặc action admin để retry pipeline

## Notes

- Auth routes đã được triển khai thủ công bằng controller/request riêng trong Laravel app.
- API routing đã được bật trong `bootstrap/app.php` với `routes/api.php`.
- Dashboard query `VideoProject` theo owner hiện tại, hiển thị thống kê, status badge, progress, metadata, và link detail.
- Naming ưu tiên RESTful cho resource chính là `video-projects`.
