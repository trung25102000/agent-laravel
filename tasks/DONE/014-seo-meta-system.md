# Task: SEO Meta System

## Status
completed

## Priority
medium

## Objective
Thiết lập hệ thống SEO meta cơ bản gồm title, meta description, Open Graph, canonical URL, sitemap và robots.txt cho website bán template/dịch vụ web.

## Requirements
- Layout hỗ trợ dynamic title/meta description.
- Open Graph tags cho homepage, template detail, blog detail.
- Canonical URL cho public pages.
- Route sitemap XML cơ bản.
- Route hoặc file robots.txt.
- Không index trang admin.
- Meta fallback từ config.

## Files Expected
- `video-generator-app/config/seo.php`
- `video-generator-app/resources/views/layouts/app.blade.php`
- `video-generator-app/app/Http/Controllers/SitemapController.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/resources/views/seo/sitemap.blade.php`
- `video-generator-app/public/robots.txt` hoặc route robots
- `video-generator-app/tests/Feature/SeoMetaTest.php`

## Implementation Notes
- Không hard-code domain, dùng `config('app.url')`.
- Sitemap chỉ chứa public active/published URLs.
- Escape meta content.
- Có thể dùng view data hoặc component SEO đơn giản.

## Done When
- Public pages có title/meta/canonical.
- Sitemap trả XML hợp lệ.
- Robots chặn admin.
- Tests pass.

## Test Requirements
- Test homepage có meta.
- Test template detail có OG tags.
- Test sitemap có active template/blog.
- Test robots không cho `/admin`.

## Suggested Git Commit Message
- `feat: add SEO metadata and sitemap`
