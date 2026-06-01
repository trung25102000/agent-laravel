# Prompt Continue

Tiếp tục workflow Autonomous Laravel Coding Agent từ trạng thái hiện tại của repo.

Làm đúng theo `.agents/AGENTS.md`.

Trước khi tiếp tục:

1. Đọc `.agents/memory/progress.md`
2. Đọc `.agents/memory/bugs.md`
3. Đọc `.agents/memory/changelog.md`
4. Đọc `.agents/context/decisions.md`
5. Đọc lại toàn bộ:
   - `/.agents/rules`
   - `/.agents/context`
   - `/.agents/memory`
   - `/tasks`

Sau đó:

- tìm task đầu tiên còn `pending`
- tiếp tục code
- ưu tiên Laravel 13.x + PHP 8.5 cho code/project mới, trừ khi .agents/rules/.agents/context ghi rõ blocker
- thao tác với source Laravel trong thư mục ứng dụng riêng được khai báo ở `.agents/context/project-context.md`
- tự test
- tự fix lỗi
- cập nhật progress
- move task completed vào `/tasks/DONE`
- lặp tiếp cho đến khi xong hoặc có blocker thật sự

Không lặp lại phần việc đã completed trừ khi việc validate cho thấy cần sửa tiếp.
