# Task: Subtitle Generation

## Status
completed

## Priority
medium

## Objective
Sinh subtitle ở định dạng SRT hoặc VTT từ script hoặc scene list và lưu file subtitle.

## Requirements
- Tạo service/action generate subtitle
- Hỗ trợ ít nhất một định dạng, ưu tiên SRT hoặc VTT
- Lưu file subtitle vào storage
- Lưu path subtitle vào database

## Files Expected
- service/action subtitle generation
- file writer cho SRT/VTT
- field/path subtitle trong database nếu cần
- test subtitle
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`

## Implementation Notes
- MVP có thể sinh subtitle từ scene timing
- Đảm bảo format file hợp lệ và có thể dùng lại ở bước render

## Done When
- Subtitle file được sinh và lưu thành công
- Path subtitle được liên kết với project
- Test pass
- Không vi phạm rules

## Test Requirements
- Unit test generator SRT/VTT
- Integration test lưu file subtitle và path liên quan
