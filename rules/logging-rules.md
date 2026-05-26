# Logging Rules

## Mục Tiêu

- Log đủ để truy vết hành vi quan trọng nhưng không gây nhiễu hoặc lộ dữ liệu nhạy cảm.

## Quy Tắc

- Log action quan trọng như tạo, cập nhật, xóa, thanh toán, đồng bộ, job fail.
- Log phải có context đủ dùng: actor, entity, action, id liên quan nếu có.
- Không log password, token, secret, raw credential, dữ liệu cá nhân nhạy cảm không cần thiết.
- Không spam log trong loop hoặc luồng nóng nếu không có mục đích rõ ràng.
- Error log phải giúp truy vết nguyên nhân nhưng vẫn an toàn.

## Checklist

- [ ] Action quan trọng đã có log nếu phù hợp
- [ ] Log có context đủ để trace
- [ ] Không log dữ liệu nhạy cảm
- [ ] Không spam log vô ích
