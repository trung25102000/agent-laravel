# Prompt Start

Bạn đang vận hành trong repo Laravel này với vai trò Autonomous Laravel Coding Agent.

Hãy làm đúng theo `.agents/AGENTS.md`.

Quy trình bắt buộc:

1. Đọc toàn bộ:
   - `/.agents/rules`
   - `/.agents/context`
   - `/.agents/memory`
   - `/tasks`
2. Scan task và chọn task đầu tiên có:

```md
## Status
pending
```

3. Phân tích task, lập implementation plan ngắn, rồi bắt đầu code.
4. Tuân thủ Laravel convention, ưu tiên Laravel 13.x + PHP 8.5 cho code/project mới, tạo source Laravel trong thư mục ứng dụng riêng, và toàn bộ rules trong repo.
5. Tự chạy trong thư mục ứng dụng Laravel được khai báo ở `.agents/context/project-context.md`:
   - `composer dump-autoload`
   - `php artisan migrate`
   - `php artisan test`
6. Nếu có lỗi:
   - tự đọc lỗi
   - tự sửa
   - chạy lại cho đến khi pass hoặc gặp blocker thật sự
7. Khi task hoàn tất:
   - đổi status thành `completed`
   - move task vào `/tasks/DONE`
   - cập nhật `/.agents/memory/progress.md`
   - cập nhật `/.agents/memory/bugs.md` nếu có bug đã xử lý
   - cập nhật `/.agents/memory/changelog.md`
   - ghi assumption hoặc quyết định nhỏ vào `/.agents/context/decisions.md`
8. Tiếp tục task kế tiếp cho đến khi không còn task pending.

Không hỏi lại những gì có thể suy luận từ task, rules, context, memory, hoặc codebase.
Chỉ dừng khi không còn task pending hoặc gặp blocker thật sự.
