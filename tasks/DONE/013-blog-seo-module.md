# Task: Blog SEO Module

## Status
completed

## Priority
medium

## Objective
Xây dựng blog SEO theo 3 nhóm khách hàng: chủ shop nhỏ/lẻ, cá nhân kinh doanh online, và sinh viên cần đồ án/source Laravel.

## Requirements
- Tạo model `BlogPost`.
- Có title, slug, excerpt, content, cover image, status draft/published, published_at, meta fields.
- Category/tag nếu cần và phù hợp scope.
- Có trường hoặc taxonomy audience: `shop_owner`, `online_seller`, `student`.
- Blog topic gợi ý:
  - Shop nhỏ: website bán hàng, catalog, landing page chốt đơn.
  - Kinh doanh online: landing page quảng cáo, form lead, Zalo/Facebook.
  - Sinh viên: Laravel đồ án, database mẫu, báo cáo, hướng dẫn chạy source.
- Admin CRUD blog post.
- Public listing blog.
- Public detail theo slug.
- Chỉ public post published.
- Slug SEO unique.

## Files Expected
- `video-generator-app/app/Models/BlogPost.php`
- `video-generator-app/database/migrations/*create_blog_posts_table.php`
- `video-generator-app/app/Enums/BlogPostStatusEnum.php`
- `video-generator-app/app/Http/Controllers/Admin/BlogPostController.php`
- `video-generator-app/app/Http/Controllers/BlogController.php`
- `video-generator-app/app/Http/Requests/StoreBlogPostRequest.php`
- `video-generator-app/app/Http/Requests/UpdateBlogPostRequest.php`
- `video-generator-app/resources/views/blog/index.blade.php`
- `video-generator-app/resources/views/blog/show.blade.php`
- `video-generator-app/resources/views/admin/blog-posts/*`
- `video-generator-app/tests/Feature/BlogPostTest.php`

## Implementation Notes
- Dùng longText cho content.
- Không render raw HTML nếu chưa sanitize.
- Nếu dùng Markdown, render qua parser an toàn hoặc escape mặc định.
- Published scope nên nằm trong model/query.

## Done When
- Admin tạo/sửa/xóa publish blog.
- Public xem blog listing/detail.
- Draft không public.
- SEO slug hoạt động.

## Test Requirements
- Test admin CRUD blog.
- Test published public listing/detail.
- Test filter/listing blog theo nhóm khách hàng nếu có taxonomy audience.
- Test draft 404 public.
- Test slug unique validation.

## Suggested Git Commit Message
- `feat: add SEO blog module`
