# Task: Template Detail Public

## Status
completed

## Priority
high

## Objective
Xây dựng trang chi tiết template giúp khách xem gallery preview, demo link, mô tả, pricing và gửi yêu cầu mua/chỉnh sửa.

## Requirements
- Route public `GET /templates/{slug}`.
- Chỉ hiển thị template active.
- Có gallery preview.
- Có demo URL mở tab mới với rel an toàn.
- Hiển thị giá/gói giá liên quan.
- CTA đặt mua, yêu cầu chỉnh sửa, liên hệ tư vấn.
- Hiển thị template liên quan cùng category.
- SEO title/meta theo template.

## Files Expected
- `video-generator-app/app/Http/Controllers/TemplateDetailController.php`
- `video-generator-app/resources/views/templates/show.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/PublicTemplateDetailTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Dùng route model binding theo slug hoặc query trong controller.
- Nếu template inactive thì 404.
- Eager load category/pricing packages nếu có.
- Không expose field admin/internal note.

## Done When
- Khách xem chi tiết template active.
- Demo link, gallery, CTA đặt mua hoạt động.
- Template inactive trả 404.

## Test Requirements
- Test detail active trả 200.
- Test inactive 404.
- Test có CTA đặt mua và demo link.
- Test related templates cùng category nếu có.

## Suggested Git Commit Message
- `feat: add public template detail page`
