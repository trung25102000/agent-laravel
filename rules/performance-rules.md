# Performance Rules

## Mục Tiêu

- Tránh các vấn đề hiệu năng phổ biến trong Laravel ngay từ lúc implement.

## Quy Tắc

- Tránh N+1 bằng eager loading khi đọc relationship trong loop.
- Chỉ select các cột cần thiết nếu query lớn hoặc trả nhiều dữ liệu.
- Dùng pagination cho danh sách lớn.
- Không xử lý nặng trong request lifecycle nếu có thể đưa sang queue.
- Không gọi service ngoài hoặc I/O đắt đỏ lặp lại không cần thiết.
- Cân nhắc cache cho dữ liệu đọc nhiều, đổi ít.
- Dùng index database cho cột search, filter, sort, join quan trọng.
- Tránh load toàn bộ dataset vào memory nếu có thể chunk, cursor, hoặc paginate.
- Không lặp query trong resource, accessor, observer mà không hiểu chi phí.

## Checklist

- [ ] Đã kiểm tra N+1
- [ ] Query lớn có select/pagination phù hợp
- [ ] Task nặng đã cân nhắc queue
- [ ] Không có I/O đắt đỏ lặp thừa
- [ ] Database index đã được cân nhắc nếu có query mới
- [ ] Không load data quá mức cần thiết
