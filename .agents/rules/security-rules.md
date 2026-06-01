# Security Rules

## Mục Tiêu

- Bảo vệ dữ liệu, tài khoản, session, token, và luồng xử lý quan trọng.
- Không chấp nhận code tiện tay nhưng làm tăng rủi ro bảo mật.

## Quy Tắc

- Validate toàn bộ input từ client.
- Không trust client data, kể cả hidden field hoặc query param nội bộ.
- Sanitize dữ liệu trước khi log hoặc hiển thị nếu có khả năng chứa thông tin nhạy cảm.
- Không expose secret, token, password, credential, private key, stack trace, SQL raw.
- Không dùng `env()` ngoài `config/`.
- Phải có authorization cho action thay đổi dữ liệu hoặc truy cập dữ liệu nhạy cảm.
- Chống mass assignment bằng `fillable` hoặc chiến lược guard rõ ràng.
- Kiểm soát upload file: mime type, size, path, visibility.
- Escape output khi render HTML nếu có dữ liệu user-generated.
- Không trả raw exception cho API hoặc web response.
- Dùng hash cho password hoặc secret cần lưu trữ.
- Không viết logic quyền hạn bằng string role rải rác trong code nếu có policy/gate tốt hơn.

## Checklist

- [ ] Input đã được validate đầy đủ
- [ ] Có authorization cho thao tác nhạy cảm
- [ ] Không có secret hard-code
- [ ] Không dùng `env()` ngoài config
- [ ] Không return raw exception hoặc stack trace
- [ ] Model đã chống mass assignment
- [ ] File upload đã được kiểm soát nếu có
- [ ] Dữ liệu nhạy cảm không bị log lộ
