# Database Rules

## Migration

- Viết migration theo chuẩn Laravel.
- Tên bảng, cột, index, foreign key phải rõ ràng.
- Migration phải có rollback hợp lệ.
- Không tạo schema mơ hồ hoặc phụ thuộc ngầm nếu có thể tránh.

## Thiết Kế Schema

- Có foreign key khi dữ liệu có quan hệ rõ ràng.
- Có index cho cột dùng để tìm kiếm, lọc, join, hoặc unique constraint.
- Không để nullable vô tội vạ. Chỉ nullable khi có lý do nghiệp vụ rõ ràng.
- Dùng soft delete khi phù hợp với yêu cầu audit hoặc khôi phục dữ liệu.

## Naming Convention

- Tên bảng dùng số nhiều, snake_case nếu theo convention Laravel.
- Tên khóa ngoại rõ ràng theo dạng `*_id`.
- Tên bảng pivot theo chuẩn Laravel nếu áp dụng.
- Tránh viết tắt khó hiểu trong tên cột và bảng.
