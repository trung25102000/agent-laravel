# Task: Attachment File Management

## Status
completed

## Priority
high

## Objective
Xây dựng module file đính kèm cho source code, báo cáo, database mẫu và hướng dẫn cài đặt/chạy project.

## Requirements
- Tạo model `ProductAttachment`.
- Hỗ trợ loại file: source, report, database, guide, document, other.
- File gắn với source code product, template hoặc order nếu cần.
- Validate file type/size an toàn.
- Lưu storage private nếu file bán hàng không public.
- Admin upload/xóa/tải file.
- Public không tải file trả phí nếu chưa có quyền.
- Không lưu absolute path.

## Files Expected
- `video-generator-app/app/Models/ProductAttachment.php`
- `video-generator-app/database/migrations/*create_product_attachments_table.php`
- `video-generator-app/app/Enums/ProductAttachmentTypeEnum.php`
- `video-generator-app/app/Services/AttachmentStorageService.php`
- `video-generator-app/app/Http/Controllers/Admin/ProductAttachmentController.php`
- `video-generator-app/app/Http/Requests/StoreProductAttachmentRequest.php`
- `video-generator-app/resources/views/admin/product-attachments/*`
- `video-generator-app/tests/Feature/ProductAttachmentTest.php`

## Implementation Notes
- Source zip/database/report nên private disk.
- Kiểm tra MIME và extension.
- Download phải authorize admin hoặc owner/order sau này.

## Done When
- Admin upload/xóa/tải attachment.
- File private không public trực tiếp.
- Metadata file lưu đúng.

## Test Requirements
- Test upload valid attachment.
- Test reject invalid/oversized file.
- Test admin download authorized.
- Test guest không tải file private.

## Suggested Git Commit Message
- `feat: add product attachment management`
