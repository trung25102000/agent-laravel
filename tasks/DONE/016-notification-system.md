# Task: Notification System

## Status
completed

## Priority
medium

## Objective
Thông báo cho user khi video render xong hoặc thất bại bằng database notification hoặc mail mock.

## Requirements
- Có notification khi render hoàn tất
- Có notification khi render thất bại nếu phù hợp
- Dùng database notification hoặc mail mock
- Tách side effect khỏi controller

## Files Expected
- notification class
- event/listener hoặc job nếu cần
- migration notifications nếu dùng database notification
- test notification
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Ưu tiên notification database cho MVP
- Có thể dispatch từ pipeline khi trạng thái chuyển sang completed/failed

## Done When
- User nhận được notification khi pipeline hoàn tất hoặc thất bại
- Side effect được tách đúng kiến trúc
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature hoặc integration test notification được tạo
- Test event/listener/job nếu có
