# Task: Voice-over Generation

## Status
pending

## Priority
medium

## Objective
Tạo service sinh voice-over hoặc text-to-speech cho video project bằng provider interface và mock provider.

## Requirements
- Có service/action tạo voice-over từ script hoặc scene list
- Có TTS provider interface
- Có mock TTS provider
- Lưu audio path vào database
- Chuẩn bị cấu trúc để thay bằng provider thật sau này

## Files Expected
- service/action voice-over
- provider interface TTS
- mock provider
- migration hoặc field audio path nếu cần
- test service
- `memory/progress.md`
- `memory/changelog.md`

## Implementation Notes
- Mock provider có thể tạo file text hoặc file audio giả trong storage để mô phỏng pipeline
- Chuẩn hóa metadata audio nếu cần như duration, provider name, mime type

## Done When
- Voice-over mock được tạo và lưu path
- Pipeline có thể dùng output này cho bước tiếp theo
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test provider/service
- Integration test lưu audio path vào project hoặc bảng liên quan
