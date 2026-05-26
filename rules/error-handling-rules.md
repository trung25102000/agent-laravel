# Error Handling Rules

## Mục Tiêu

- Xử lý lỗi rõ ràng, nhất quán, dễ debug nhưng không làm lộ thông tin nhạy cảm.

## Quy Tắc

- Dùng custom exception rõ nghĩa cho business rule quan trọng.
- Không throw exception chung chung khi có thể biểu đạt rõ loại lỗi.
- Không nuốt exception im lặng.
- Khi bắt exception, phải có lý do rõ ràng và hành vi fallback hợp lý.
- API phải trả lỗi nhất quán, status code đúng.
- Không lộ stack trace, SQL, path hệ thống, secret trong response.
- Multi-step operation phải rollback đúng cách nếu có lỗi.

## Checklist

- [ ] Exception phản ánh đúng lỗi nghiệp vụ hoặc hệ thống
- [ ] Không có `catch` vô nghĩa
- [ ] API/web response lỗi nhất quán
- [ ] Không lộ thông tin nội bộ trong lỗi
- [ ] Transaction rollback đúng nếu có multi-write
