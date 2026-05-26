# Task: API Endpoints

## Status
pending

## Priority
high

## Objective
Xây dựng API nội bộ rõ ràng cho việc tạo video project, xem trạng thái, và lấy kết quả video.

## Requirements
- API tạo `VideoProject`
- API xem trạng thái project
- API lấy kết quả video
- Dùng `FormRequest`
- Dùng `API Resource`
- HTTP status code đúng

## Files Expected
- `routes/api.php`
- API controller
- `FormRequest`
- `Resource`
- test API
- `context/routes-map.md`
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- API nên bám contract nhất quán cho success/error
- Scope dữ liệu theo user hiện tại hoặc token nếu auth API đã có
- Không return raw model

## Done When
- API create/status/result hoạt động đúng
- Validation và resource chuẩn
- Test pass
- Không vi phạm rules

## Test Requirements
- Feature test API create project
- Feature test API status
- Feature test API result
- Feature test unauthorized/forbidden cases
