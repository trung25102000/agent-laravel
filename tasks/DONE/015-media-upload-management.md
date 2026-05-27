# Task: Media Upload Management

## Status
completed

## Priority
high

## Objective
Xây dựng quản lý upload ảnh cho template và blog, bảo đảm validate file, lưu storage public đúng cách và xóa file an toàn.

## Requirements
- Upload ảnh preview template, gallery, cover blog.
- Validate mime: jpg, jpeg, png, webp.
- Validate size tối đa qua config.
- Lưu vào storage public hoặc disk cấu hình.
- Không lưu absolute path trong database.
- Xóa file cũ an toàn khi thay ảnh.
- Không cho upload file thực thi.
- Có fallback placeholder nếu thiếu ảnh.

## Files Expected
- `video-generator-app/config/media.php`
- `video-generator-app/app/Services/MediaUploadService.php`
- `video-generator-app/app/Http/Requests/*`
- `video-generator-app/resources/views/admin/*`
- `video-generator-app/tests/Feature/MediaUploadTest.php`
- `video-generator-app/README.md`

## Implementation Notes
- Dùng `Storage` facade.
- File name nên random/slug an toàn.
- Không trust client file extension.
- Nếu cần `php artisan storage:link`, ghi README.

## Done When
- Admin upload/thay/xóa ảnh template/blog.
- File lưu đúng disk.
- DB chỉ lưu relative path.
- File cũ được xóa khi thay nếu không dùng nơi khác.

## Test Requirements
- Test upload valid image.
- Test reject invalid mime.
- Test reject oversized file.
- Test delete/replace old file.

## Suggested Git Commit Message
- `feat: add media upload management`
