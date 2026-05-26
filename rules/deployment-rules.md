# Deployment Rules

## Mục Tiêu

- Giữ thay đổi an toàn cho môi trường triển khai và vận hành.

## Quy Tắc

- Không commit secret hoặc env nhạy cảm.
- Migration phải an toàn khi chạy trên môi trường thật.
- Thay đổi queue, scheduler, storage, cache, mail, broadcast phải được ghi chú rõ.
- Không thêm bước deploy thủ công mơ hồ mà không tài liệu hóa.
- Các thay đổi có ảnh hưởng runtime phải cập nhật tài liệu hoặc note vận hành.

## Checklist

- [ ] Không có secret trong code hoặc tài liệu
- [ ] Migration an toàn để deploy
- [ ] Thay đổi infra/runtime đã được ghi chú
- [ ] Không có bước vận hành mơ hồ bị bỏ sót
