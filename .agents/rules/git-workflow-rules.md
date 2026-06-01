# Git Workflow Rules

## Mục Tiêu

- Giữ lịch sử thay đổi rõ ràng, hạn chế đụng vào phần không liên quan.

## Quy Tắc

- Chỉ sửa file phục vụ trực tiếp cho task.
- Không revert thay đổi của user nếu không được yêu cầu.
- Không commit secret, file tạm, dump debug, hoặc log nội bộ.
- Nếu task cần refactor, refactor phải bám phạm vi hợp lý và có lý do rõ ràng.
- Changelog và progress phải phản ánh đúng thay đổi đã làm.

## Checklist

- [ ] Chỉ sửa file liên quan
- [ ] Không đè thay đổi của user
- [ ] Không thêm file rác hoặc debug artifact
- [ ] Memory/changelog được cập nhật đúng
