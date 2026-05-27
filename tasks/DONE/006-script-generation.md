# Task: Script Generation

## Status
completed

## Priority
high

## Objective
Triển khai service tạo script video từ input user và lưu kết quả vào database.

## Requirements
- Tạo service hoặc action sinh script từ `VideoProject`
- Có provider interface cho AI script generation
- Có mock provider dùng trước khi tích hợp AI thật
- Lưu script vào database hoặc bảng/field phù hợp
- Cập nhật trạng thái project sang bước scripting khi chạy

## Files Expected
- `app/Services` hoặc `app/Actions` liên quan đến script generation
- interface provider AI
- mock provider
- migration bổ sung field script nếu cần
- controller/job/service orchestration liên quan
- test service
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Không khóa chặt logic vào một vendor AI cụ thể
- Provider nên trả cấu trúc rõ ràng: title, hook, body, CTA hoặc script text hoàn chỉnh
- Nếu chạy đồng bộ cho MVP, vẫn giữ interface để sau này chuyển qua queue dễ dàng

## Done When
- Có thể tạo script từ dữ liệu project bằng mock provider
- Script được lưu bền vững
- Trạng thái project phản ánh đúng bước xử lý
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test cho service/action tạo script
- Feature hoặc integration test xác nhận script được lưu vào project
