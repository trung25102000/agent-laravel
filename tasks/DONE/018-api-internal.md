# Task: API Internal

## Status
completed

## Priority
low

## Objective
Tạo API nội bộ khi cần để frontend/admin tương tác bằng JSON, bảo đảm response nhất quán, validation và authorization đầy đủ.

## Requirements
- Chỉ tạo API nếu có nhu cầu thực tế từ UI hoặc integration.
- API trả JSON chuẩn nhất quán.
- Dùng API Resource cho model chính.
- Validation bằng FormRequest.
- Authorization admin/owner rõ ràng.
- Không expose dữ liệu nhạy cảm.
- Có throttle nếu public API.

## Files Expected
- `video-generator-app/routes/api.php`
- `video-generator-app/app/Http/Controllers/Api/*`
- `video-generator-app/app/Http/Requests/Api/*`
- `video-generator-app/app/Http/Resources/*`
- `video-generator-app/tests/Feature/Api/*`
- `.agents/context/routes-map.md`

## Implementation Notes
- Nếu project chỉ dùng Blade server-render, task có thể ghi rõ không cần API thêm và chỉ chuẩn hóa endpoint tối thiểu.
- Không return raw model.
- Status code đúng ngữ nghĩa.

## Done When
- API nội bộ cần thiết hoạt động.
- Unauthorized/forbidden/validation fail trả JSON đúng.
- Routes map cập nhật.

## Test Requirements
- Test JSON response shape.
- Test validation fail.
- Test authorization fail.
- Test success path.

## Suggested Git Commit Message
- `feat: add internal marketplace API endpoints`
