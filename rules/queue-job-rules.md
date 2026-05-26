# Queue Job Rules

## Mục Tiêu

- Tách các tác vụ nặng hoặc bất đồng bộ ra khỏi request lifecycle.

## Quy Tắc

- Dùng Job cho tác vụ nặng, gọi dịch vụ ngoài, gửi mail, xử lý file lớn, đồng bộ chậm.
- Job phải idempotent nếu có thể.
- Job phải có input tối thiểu và rõ ràng.
- Không truyền object quá nặng hoặc state khó serialize vào queue.
- Retry phải có chủ đích, không retry mù quáng.
- Failure phải được log hoặc xử lý rõ.

## Checklist

- [ ] Task nặng đã được cân nhắc đưa vào queue
- [ ] Job có input rõ ràng
- [ ] Retry/failure có chủ đích
- [ ] Không serialize dữ liệu thừa
