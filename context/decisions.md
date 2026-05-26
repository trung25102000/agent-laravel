# Decisions Log

File này dùng để ghi lại các quyết định kỹ thuật, assumptions, và workaround mà Codex tự đưa ra khi task chưa mô tả hết chi tiết nhưng vẫn đủ an toàn để tiếp tục.

## Format

- Ngày:
- Task:
- Loại: decision / assumption / workaround
- Nội dung:
- Lý do:
- Ảnh hưởng:

## Entries

- Ngày: 2026-05-26
- Task: bootstrap autonomous agents system
- Loại: decision
- Nội dung: Khởi tạo đầy đủ bộ file rules, context, memory, prompts, và task mẫu để repo có thể vận hành theo mô hình task-driven cho Laravel.
- Lý do: Repo cần một nền tảng thống nhất để Codex có thể tự đọc, tự thực thi, và tự tiếp tục qua nhiều session.
- Ảnh hưởng: Các lần chạy sau chỉ cần thêm task vào `/tasks` và dùng prompt trong `/prompts`.

- Ngày: 2026-05-26
- Task: 000-project-overview
- Loại: assumption
- Nội dung: Chọn Blade + web routes chuẩn Laravel làm hướng MVP ban đầu, đồng thời giữ API nội bộ và provider interface để các tích hợp AI/TTS/render thật có thể thay vào sau.
- Lý do: Repo chưa có source code Laravel, nên cần một hướng triển khai rõ ràng, ít phụ thuộc, và phù hợp backlog hiện tại.
- Ảnh hưởng: Các task tiếp theo sẽ ưu tiên bootstrap một web app Laravel truyền thống trước, thay vì chọn SPA stack phức tạp hơn.

- Ngày: 2026-05-26
- Task: 000-project-overview
- Loại: decision
- Nội dung: Ghi rõ trong context rằng repo hiện chưa có source Laravel và việc khởi tạo framework là điều kiện tiên quyết cho task kỹ thuật tiếp theo.
- Lý do: Điều này phản ánh trạng thái thực tế của workspace và giúp phân biệt blocker môi trường với lỗi triển khai.
- Ảnh hưởng: Task 001 sẽ phải xác minh khả năng khởi tạo Laravel trước khi tiếp tục các module sản phẩm.
