# Hệ Thống Autonomous Laravel Agents

Repo này được vận hành theo mô hình `task-driven autonomous coding system` cho Laravel. Khi Codex được chạy bằng prompt khởi động hoặc prompt tiếp tục, Codex phải tự đọc toàn bộ ngữ cảnh dự án, chọn task cần làm, tự triển khai, tự kiểm tra, tự sửa lỗi, tự cập nhật tiến độ, rồi tiếp tục lặp cho đến khi toàn bộ task hoàn tất hoặc gặp blocker thật sự.

## 1. Bắt Buộc Phải Đọc Trước Khi Code

Trước khi thực hiện bất kỳ thay đổi nào trong code, Codex bắt buộc phải đọc toàn bộ các thư mục sau:

1. `/rules`
2. `/context`
3. `/memory`
4. `/tasks`

Không được bắt đầu code nếu chưa hoàn tất bước đọc này.
Phải đọc toàn bộ các file rules hiện có trong `/rules`, không được bỏ sót file nào.

## 2. Cách Chọn Task

- Scan toàn bộ file trong `/tasks`.
- Bỏ qua thư mục `/tasks/DONE`.
- Chọn task đầu tiên theo thứ tự tên file mà có:

```md
## Status
pending
```

- Chỉ làm một task tại một thời điểm.
- Khi hoàn tất task hiện tại thì mới chuyển sang task tiếp theo.

## 3. Workflow Bắt Buộc

Cho mỗi task đang ở trạng thái `pending`, Codex phải thực hiện tuần tự:

1. Đọc task và hiểu mục tiêu, requirements, files expected, done when.
2. Đọc code Laravel liên quan trước khi sửa.
3. Tạo implementation plan ngắn.
4. Code theo đúng rules trong `/rules`.
5. Chạy các lệnh xác thực:
   - `composer dump-autoload`
   - `php artisan migrate`
   - `php artisan test`
6. Nếu có lỗi:
   - tự đọc lỗi
   - tự tìm nguyên nhân
   - tự sửa
   - chạy lại các lệnh cần thiết
7. Khi task hoàn tất:
   - chạy các agent review bắt buộc trong `/agents`
   - tự sửa mọi lỗi fail do review agent phát hiện
   - đổi status trong file task thành `completed`
   - move file task sang `/tasks/DONE`
   - cập nhật `/memory/progress.md`
   - cập nhật `/memory/changelog.md` nếu có thay đổi đáng kể
   - cập nhật `/memory/bugs.md` nếu có bug hoặc lỗi môi trường đã xử lý
8. Quay lại scan `/tasks` và tiếp tục task tiếp theo.

Trước khi đánh dấu task là hoàn tất, Codex phải tự rà soát lại implementation với toàn bộ rule files. Nếu phát hiện vi phạm rules, Codex phải tự refactor lại code trước khi đổi status thành `completed`.
Trước khi move task vào `/tasks/DONE`, Codex bắt buộc phải chạy review theo các agent liên quan trong `/agents`, tối thiểu gồm security, testing, refactor/convention, và documentation nếu task tạo hoặc đổi hành vi hệ thống.

## 4. Quy Tắc Hành Vi

- Không hỏi lại user nếu task, rules, context, memory, hoặc codebase đã đủ thông tin để suy luận.
- Nếu thiếu chi tiết nhỏ:
  - tự quyết định theo hướng hợp lý, an toàn, dễ maintain
  - ghi quyết định đó vào `/context/decisions.md`
- Không phá cấu trúc hiện tại của project nếu không cần.
- Không sửa file không liên quan nếu không phục vụ trực tiếp cho task.
- Ưu tiên code sạch, rõ ràng, dễ maintain, dễ test.
- Phải tuân thủ Laravel convention.
- Phải ưu tiên bảo mật.
- Phải tạo test cho chức năng chính.
- Không được expose secrets, token, credential, hoặc thông tin nhạy cảm.
- Không dùng `env()` ngoài các file config.
- Không hard-code config nếu có thể đưa vào config hoặc constant phù hợp.

## 5. Nguyên Tắc Laravel

- Controller phải mỏng.
- Validation phải dùng `FormRequest`.
- Business logic phải đặt trong `Service`, `Action`, hoặc lớp phù hợp.
- Query logic phức tạp có thể tách `Repository`.
- Model phải khai báo `fillable` hoặc chiến lược guard rõ ràng.
- Model phải có `casts` và relationships khi phù hợp.
- API response nên dùng `Resource`.
- Phải có authorization cho thao tác quan trọng.
- Phải dùng eager loading khi cần để tránh N+1.
- Migration phải rõ ràng, reversible, có index và foreign key phù hợp.

## 6. Quy Tắc Tự Chủ

- Nếu một lỗi có thể sửa được bằng cách đọc stack trace, test failure, migration error, route error, config error, hoặc code hiện có, Codex phải tự sửa thay vì dừng lại hỏi.
- Nếu một task còn thiếu một chi tiết nhỏ như tên field phụ, response shape nhỏ, tên class hợp lý, vị trí file hợp lý, Codex phải tự quyết định và ghi lại vào `context/decisions.md`.
- Chỉ được xem là blocker thật sự nếu:
  - thiếu dependency hoặc service quan trọng mà repo không cung cấp
  - requirement mâu thuẫn nghiêm trọng và không thể suy luận
  - hành động tiếp theo có nguy cơ phá dữ liệu hoặc phá kiến trúc hiện tại
  - môi trường chạy thiếu thành phần bắt buộc nên không thể validate

## 7. Điều Kiện Dừng

Codex chỉ được dừng khi:

1. Không còn task nào ở trạng thái `pending` trong `/tasks`
2. Hoặc gặp blocker thật sự

Nếu dừng do blocker, phải ghi rõ:

- task nào bị chặn
- lỗi gì
- đã thử gì
- cần gì để tiếp tục

Thông tin này phải được cập nhật vào:

- `/memory/progress.md`
- `/memory/bugs.md` nếu phù hợp
- file task đang bị chặn

Nếu fail security, fail test, hoặc fail convention/rules review thì không được:

- đổi task thành `completed`
- move task vào `/tasks/DONE`

## 8. Quy Tắc Cập Nhật Bộ Nhớ

Sau mỗi task hoàn tất hoặc sau mỗi blocker thật sự, Codex phải cập nhật:

- `/memory/progress.md`: trạng thái hiện tại, task completed, task đang làm, blocker
- `/memory/changelog.md`: thay đổi chức năng hoặc thay đổi kiến trúc đáng chú ý
- `/memory/bugs.md`: bug đã gặp, nguyên nhân, cách sửa
- `/context/decisions.md`: quyết định kỹ thuật hoặc assumption đã tự suy luận

## 9. Review Agents Bắt Buộc

Trước khi đóng task, Codex phải đọc và áp dụng các agent trong `/agents` theo phạm vi công việc. Tối thiểu phải có:

- `security-agent.md`
- `testing-agent.md`
- `refactor-agent.md`

Các agent khác phải chạy nếu task có liên quan trực tiếp:

- `database-agent.md` cho schema, migration, query, transaction
- `api-contract-agent.md` cho API, resource, request/response
- `documentation-agent.md` khi thay đổi behavior, cấu hình, luồng hệ thống
- `devops-agent.md` khi thay đổi queue, deploy, env, worker, scheduler, storage, infra

Nếu bất kỳ agent bắt buộc nào fail, Codex phải sửa cho đến khi pass hoặc ghi nhận blocker thật sự.

## 10. Mục Tiêu Cuối Cùng

Mục tiêu của Codex trong repo này là:

- tự vận hành như một Laravel coding agent
- nhận task từ `/tasks`
- hoàn thiện dần toàn bộ project
- luôn bám rules, context, memory
- giảm tối đa việc phải hỏi lại user
