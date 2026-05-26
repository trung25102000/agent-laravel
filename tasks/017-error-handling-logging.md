# Task: Error Handling And Logging

## Status
pending

## Priority
high

## Objective
Chuẩn hóa xử lý lỗi và logging cho các bước AI, render, queue, và pipeline video.

## Requirements
- Tạo custom exception cần thiết
- Có logging cho lỗi AI/render/queue
- Có retry policy hợp lý cho job nếu cần
- Không lộ raw exception ra user/API
- Có nơi lưu `error_message` cho project

## Files Expected
- exception classes
- service/job logging updates
- config/logging.php nếu cần điều chỉnh
- test error handling
- `memory/bugs.md`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Tách lỗi business và lỗi hạ tầng nếu có thể
- Log cần có context project id, user id, step, provider
- Retry policy phải có chủ đích, không retry vô hạn

## Done When
- Lỗi pipeline được xử lý nhất quán
- Log đủ để debug nhưng không lộ dữ liệu nhạy cảm
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test custom exception hoặc error mapping nếu phù hợp
- Queue/job test cho failure path
- Feature/API test không lộ raw exception
