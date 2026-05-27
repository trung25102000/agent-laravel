# Routes Map

Dùng file này để ghi lại map các route hiện có trong dự án Laravel sau khi Codex hoặc developer đã phân tích codebase.

## Web Routes

- `GET /` branded landing page cho AI Video Generator, có CTA login/register hoặc dashboard khi đã đăng nhập
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

- `GET /admin` dashboard admin gộp danh sách users và video projects, hỗ trợ query `status`, middleware `auth`, gate `access-admin`
- `GET /admin/users` chưa tách route riêng trong MVP
- `GET /admin/video-projects` chưa tách route riêng trong MVP
- `POST /internal/pipeline/video-projects/{videoProject}/start` route nội bộ nếu cần orchestration tách khỏi UI
- `POST /internal/pipeline/video-projects/{videoProject}/retry` route nội bộ hoặc action admin để retry pipeline

## Notes

- Auth routes đã được triển khai thủ công bằng controller/request riêng trong Laravel app.
- API routing đã được bật trong `bootstrap/app.php` với `routes/api.php`.
- Dashboard query `VideoProject` theo owner hiện tại, hiển thị thống kê, status badge, progress, metadata, và link detail.
- Naming ưu tiên RESTful cho resource chính là `video-projects`.
