# Task: Admin Dashboard

## Status
completed

## Priority
medium

## Objective
Tạo admin dashboard cơ bản để admin theo dõi users và video projects.

## Requirements
- Admin xem danh sách users
- Admin xem danh sách video projects
- Có filter theo status
- Có route và middleware/admin authorization phù hợp

## Files Expected
- controller admin
- route admin
- view admin dashboard/listing
- middleware/policy/gate admin
- test admin dashboard
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Dùng role hoặc cờ `is_admin` tối giản cho MVP
- Giữ tách biệt route admin với route user

## Done When
- Admin xem được users và video projects
- Có filter status hoạt động
- Non-admin không truy cập được
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature test admin truy cập được dashboard
- Feature test user thường bị chặn
- Feature test filter status hoạt động
