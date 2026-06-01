# Task: Blog SEO Content Pillars And Internal Linking

## Status
completed

## Priority
medium

## Objective
Mở rộng blog theo các trụ cột nội dung phù hợp với dịch vụ: SEO, website, landing page, đồ án, fix bug và task code, đồng thời tăng internal linking để hỗ trợ chuyển đổi.

## Requirements
- Rà soát module blog hiện có.
- Tạo hoặc mở rộng taxonomy/content strategy cho các nhóm bài:
  - SEO website
  - kinh nghiệm làm landing page
  - sửa lỗi/tối ưu giao diện
  - hướng dẫn đồ án/sinh viên
  - chia sẻ kỹ thuật web/code/app
- Mỗi bài nên liên kết tới service liên quan và CTA mềm.
- Cải thiện danh sách blog, card preview, related links hoặc section bài liên quan nếu phù hợp.
- Kiểm tra title/meta/heading của blog theo hướng SEO-friendly hơn.

## Files Expected
- `seo-web-app/app/Models/BlogPost.php`
- `seo-web-app/resources/views/marketplace/blog/index.blade.php`
- `seo-web-app/resources/views/marketplace/blog/show.blade.php`
- `seo-web-app/tests/Feature/BlogContentPillarsTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Không cần tạo CMS phức tạp nếu admin hiện có đủ dùng.
- Ưu tiên internal linking hữu ích, không nhồi link cơ học.

## Done When
- Blog phục vụ rõ cho SEO và lead generation.
- Bài viết có đường dẫn chuyển sang service/contact hợp lý.

## Test Requirements
- Test blog index/show.
- Test có CTA/link sang dịch vụ liên quan ở nơi phù hợp.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: expand blog content pillars and internal linking
