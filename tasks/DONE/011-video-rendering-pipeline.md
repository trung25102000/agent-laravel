# Task: Video Rendering Pipeline

## Status
completed

## Priority
high

## Objective
Xây dựng pipeline render video bằng queue job, với mock output trước khi tích hợp FFmpeg thật.

## Requirements
- Tạo `RenderVideoJob`
- Job phải dùng queue
- Pipeline lấy dữ liệu từ script, scenes, audio, subtitle, assets
- Tạo mock video output hoặc file placeholder trước nếu chưa có FFmpeg
- Lưu output path vào database
- Cập nhật trạng thái project trong quá trình render

## Files Expected
- `app/Jobs/RenderVideoJob.php`
- service/action render pipeline
- render provider interface
- mock render provider
- migration hoặc field output path nếu cần
- test job/pipeline
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`

## Implementation Notes
- Dùng transaction và status update cẩn thận
- Mock output có thể là file text/video giả để kiểm chứng pipeline
- Giữ render provider tách biệt để sau này thay bằng FFmpeg hoặc service ngoài

## Done When
- Job có thể chạy và tạo output mock thành công
- Queue flow hoạt động đúng
- Project nhận output path và trạng thái phù hợp
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test render service/provider
- Queue/job test dispatch và handle thành công
- Integration test project nhận output path
