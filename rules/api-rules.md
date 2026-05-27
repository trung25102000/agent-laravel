# API Rules

## Thiết Kế API

- Tuân thủ RESTful API khi task là API module.
- Route, controller action, status code phải rõ ràng và nhất quán.
- Trả response bằng JSON format thống nhất.
- Dùng API Resource để chuẩn hóa response khi phù hợp.
- Với Laravel 13, không giả định `routes/api.php` luôn tồn tại trong skeleton mới. Nếu cần API routes, bật hoặc tạo theo cơ chế chính thức và ghi lại vào `context/routes-map.md`.
- Khi response cần chuẩn JSON:API, ưu tiên JSON:API resources chính thức nếu project đã chọn chuẩn đó.

## Validation và Error Handling

- Validation phải đầy đủ cho input.
- Trả HTTP status code đúng ngữ nghĩa.
- Không trả raw exception cho client.
- Không để lộ stack trace, SQL, credential, hoặc thông tin nội bộ trong response.

## Response Format

- Response nên nhất quán giữa các endpoint.
- Khi codebase đã có chuẩn response chung, phải bám theo chuẩn đó.
- Khi chưa có chuẩn, ưu tiên response rõ ràng, dễ parse, và có thể mở rộng.
