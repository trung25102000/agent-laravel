# Laravel Code Rules

## Kiến Trúc

- Controller phải mỏng, chỉ làm nhiệm vụ nhận request, gọi service/action, trả response.
- Business logic phải đưa vào `Service` hoặc `Action`.
- Nếu query logic phức tạp, có thể tách `Repository`.
- Không viết code duplicate nếu có thể tái sử dụng.

## Validation và HTTP Layer

- Dùng `FormRequest` cho toàn bộ validation của thao tác ghi dữ liệu.
- Không nhét validation inline vào controller trừ trường hợp cực nhỏ và đã có pattern sẵn trong codebase.
- Dùng `Resource` cho API response khi dữ liệu có cấu trúc rõ ràng hoặc cần chuẩn hóa.

## Cấu Hình và Bảo Mật

- Không hard-code config nếu có thể đưa vào config file, enum, constant, hoặc class chuyên dụng.
- Không dùng `env()` ngoài thư mục `config/`.
- Không expose secrets, token, password, API key, credential trong code, log, test fixture, hoặc response.

## Eloquent và Query

- Model phải có type rõ ràng cho dữ liệu quan trọng thông qua `casts`.
- Model phải khai báo `fillable` hoặc chiến lược guard có chủ đích.
- Khai báo relationships đầy đủ khi có liên kết dữ liệu.
- Dùng eager loading khi cần để tránh N+1 query.
- Ưu tiên truy vấn dễ đọc, dễ maintain, và có thể test được.

## Chất Lượng Code

- Có type hint đầy đủ khi phù hợp.
- Có return type cho method nếu codebase hỗ trợ và phù hợp với version PHP hiện tại.
- Tên class, method, biến phải dễ hiểu.
- Ưu tiên code rõ ràng hơn code ngắn.
- Không thêm logic không liên quan vào cùng một class.

## Authorization

- Các thao tác quan trọng như create, update, delete, publish, approve phải có authorization rõ ràng.
- Ưu tiên policy, gate, hoặc layer authorization đã có trong codebase.
