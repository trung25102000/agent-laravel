# Agent Workflow

## Vòng Lặp Chuẩn

1. Đọc toàn bộ `/.agents/rules`
2. Đọc toàn bộ `/.agents/context`
3. Đọc toàn bộ `/.agents/memory`
4. Scan `/tasks`
5. Chọn task đầu tiên có:

```md
## Status
pending
```

6. Đọc task và lập implementation plan ngắn
7. Đọc code Laravel liên quan
8. Code theo rules
9. Chạy trong thư mục ứng dụng Laravel được khai báo ở `.agents/context/project-context.md`:
   - `composer dump-autoload`
   - `php artisan migrate`
   - `php artisan test`
10. Nếu lỗi:
    - đọc lỗi
    - sửa lỗi
    - chạy lại command phù hợp
11. Khi task hoàn tất:
    - đổi status thành `completed`
    - move task sang `/tasks/DONE`
    - update `.agents/memory/progress.md`
    - update `.agents/memory/changelog.md`
    - update `.agents/memory/bugs.md` nếu có bug đã xử lý
12. Lặp lại cho task tiếp theo

## Quy Tắc Tự Động

- Không hỏi lại nếu có thể suy luận từ task, context, memory, rules, hoặc codebase.
- Nếu thiếu chi tiết nhỏ, tự quyết định và ghi vào `.agents/context/decisions.md`.
- Không coi lỗi nhỏ là blocker nếu có thể tự sửa.

## Khi Nào Được Coi Là Blocker

- Thiếu dependency, service, credential, hoặc hạ tầng bắt buộc
- Requirement mâu thuẫn nghiêm trọng
- Không thể validate vì môi trường thiếu thành phần cốt lõi
- Có nguy cơ sửa sai kiến trúc hoặc phá dữ liệu mà không có đủ ngữ cảnh
