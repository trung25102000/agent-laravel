# Task: Template Listing Public

## Status
completed

## Priority
high

## Objective
Xây dựng trang public danh sách mẫu web để khách hàng tìm kiếm, lọc theo danh mục, sort theo giá/mới nhất và phân trang.

## Requirements
- Route public `GET /templates`.
- Hiển thị template active.
- Filter theo category slug.
- Search theo title, summary, tech stack hoặc ngành.
- Sort theo mới nhất, giá tăng, giá giảm.
- Pagination.
- Empty state thân thiện.
- Không hiển thị template inactive.

## Files Expected
- `video-generator-app/app/Http/Controllers/TemplateListingController.php`
- `video-generator-app/resources/views/templates/index.blade.php`
- `video-generator-app/resources/views/components/template-card.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/PublicTemplateListingTest.php`
- `.agents/context/routes-map.md`

## Implementation Notes
- Dùng query builder rõ ràng, tránh N+1 bằng `with('category')`.
- Validate query sort/category hợp lệ.
- Preserve query string khi paginate.
- Có canonical URL cơ bản nếu SEO system đã có.

## Done When
- Khách xem được danh sách template.
- Filter/search/sort/pagination hoạt động.
- UI responsive và dễ scan.

## Test Requirements
- Test listing chỉ active.
- Test filter category.
- Test search.
- Test sort price/newest.
- Test pagination.

## Suggested Git Commit Message
- `feat: add public template listing`
