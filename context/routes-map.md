# Routes Map

Dùng file này để ghi lại map các route hiện có trong dự án Laravel sau khi Codex hoặc developer đã phân tích codebase.

## Web Routes

- `GET /` trang landing hoặc redirect theo trạng thái đăng nhập
- `GET /login` hiển thị form đăng nhập
- `POST /login` xử lý đăng nhập
- `GET /register` hiển thị form đăng ký
- `POST /register` xử lý đăng ký
- `POST /logout` đăng xuất
- `GET /dashboard` dashboard user, liệt kê video projects của owner
- `GET /video-projects/create` form tạo yêu cầu video
- `POST /video-projects` lưu yêu cầu video mới
- `GET /video-projects/{videoProject}` xem chi tiết project
- `GET /video-projects/{videoProject}/preview` preview video output
- `GET /video-projects/{videoProject}/download` tải video output

## API Routes

- `POST /api/video-projects` tạo video project qua API
- `GET /api/video-projects/{videoProject}` lấy chi tiết project
- `GET /api/video-projects/{videoProject}/status` lấy trạng thái và progress
- `GET /api/video-projects/{videoProject}/result` lấy metadata video output
- `POST /api/video-projects/{videoProject}/generate-script` trigger generation nếu cần tách bước ở nội bộ
- `POST /api/video-projects/{videoProject}/render` trigger render nếu cần ở nội bộ/admin

## Auth / Admin / Internal Routes

- `GET /admin` dashboard admin
- `GET /admin/users` danh sách users
- `GET /admin/video-projects` danh sách video projects và filter theo status
- `POST /internal/pipeline/video-projects/{videoProject}/start` route nội bộ nếu cần orchestration tách khỏi UI
- `POST /internal/pipeline/video-projects/{videoProject}/retry` route nội bộ hoặc action admin để retry pipeline

## Notes

- Route chính thức sẽ được cập nhật sau khi source Laravel được khởi tạo và stack auth/UI được chọn.
- Naming ưu tiên RESTful cho resource chính là `video-projects`.
