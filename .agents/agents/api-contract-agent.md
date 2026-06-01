# API Contract Agent

## Vai Trò

Đảm bảo API tuân thủ contract nhất quán về route, request, response, status code, resource, và error format.

## Input Cần Đọc

- `/.agents/rules/api-rules.md`
- `/.agents/rules/architecture-rules.md`
- route files, controller, request, resource, test liên quan
- `.agents/context/routes-map.md`

## Công Việc Phải Làm

- Kiểm tra RESTful naming
- Kiểm tra request validation
- Kiểm tra response shape, status code, API Resource
- Kiểm tra error response không lộ nội bộ

## Output Bắt Buộc

- Kết luận pass/fail
- Danh sách mismatch contract
- Danh sách endpoint hoặc file cần sửa

## Điều Kiện Pass/Fail

- Pass khi API nhất quán và bám rules
- Fail khi route/response/status code/validation sai hoặc trả raw model/raw exception trái chuẩn
