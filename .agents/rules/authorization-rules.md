# Authorization Rules

## Mục Tiêu

- Mọi thao tác quan trọng phải được bảo vệ bằng cơ chế quyền hạn rõ ràng.

## Quy Tắc

- Tất cả action mutate data phải authorize.
- Đọc dữ liệu nhạy cảm cũng phải authorize khi cần.
- Ưu tiên Policy hoặc Gate thay vì check role inline trong controller.
- Không phụ thuộc vào client để quyết định quyền hạn.
- Không bypass authorization ở service nếu controller đã gọi sai luồng.
- Các query trả dữ liệu theo user scope phải được giới hạn rõ ràng.

## Checklist

- [ ] Tạo/sửa/xóa đã có authorization
- [ ] Dữ liệu nhạy cảm có access control
- [ ] Không có check role inline lặp lại vô tổ chức
- [ ] Query theo scope người dùng đã được giới hạn
