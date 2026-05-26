# Testing Rules

## Nguyên Tắc Chung

- Phải chạy `php artisan test` sau mỗi task.
- Chức năng chính phải có test.
- Test phải phản ánh hành vi thực tế của module.

## Loại Test

- Dùng feature test cho flow HTTP hoặc API của module chính.
- Dùng unit test cho service, action, hoặc logic quan trọng cần tách biệt.

## Tối Thiểu Phải Cover

- Happy path
- Validation fail
- Authorization fail nếu có quyền hạn
- Các nhánh lỗi quan trọng nếu task có rủi ro cao

## Chất Lượng Test

- Tên test phải mô tả được hành vi.
- Dữ liệu test nên tối giản nhưng đủ ý nghĩa.
- Tránh test mơ hồ hoặc chỉ assert quá hời hợt.
