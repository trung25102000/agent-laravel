# Task: Problem Solution Storytelling Sections

## Status
completed

## Priority
high

## Objective
Nâng cấp section vấn đề và giải pháp trên homepage để khách hàng nhận ra pain point của mình ngay và thấy rõ hướng xử lý tương ứng.

## Requirements
- Tạo section `Khách hàng đang gặp vấn đề gì` dạng card hiện đại.
- Các vấn đề cần xuất hiện rõ:
  - Không biết làm website ở đâu
  - Website tải chậm
  - Website không có khách
  - Landing Page không chuyển đổi
  - Đồ án sắp tới hạn
  - Không đủ người xử lý task
- Mỗi card cần:
  - icon/visual riêng
  - hover animation
  - copy ngắn, dễ đọc
- Tạo section `Giải pháp` tương ứng:
  - timeline hoặc card mapping từng pain point sang solution
  - thể hiện rõ cách dịch vụ xử lý vấn đề
- Có visual hierarchy mạnh hơn section hiện tại.

## Subtasks
- Rà soát section problem/story hiện có.
- Thiết kế lại card pain points với icon/hover states.
- Thêm section solution mapping.
- Tối ưu copy cho user phổ thông.
- Cập nhật tests cho markers và nội dung mới.

## Files Expected
- `seo-web-app/resources/views/marketplace/home.blade.php`
- `seo-web-app/resources/css/app.css`
- `seo-web-app/resources/js/app.js`
- `seo-web-app/tests/Feature/LandingPageExperienceTest.php`
- `seo-web-app/tests/Feature/ProblemStoryCarouselTest.php`

## Implementation Notes
- Nếu giữ carousel hiện tại, phải làm nó mạnh hơn về thị giác và logic pain/solution.
- Có thể chuyển một phần carousel thành static grid nếu conversion tốt hơn.

## Done When
- Section pain points và solution đọc vào là hiểu ngay khách đang gặp gì và website xử lý thế nào.
- Hover/reveal animation hoạt động mượt.
- Copy dễ scan trên mobile.

## Test Requirements
- Test homepage có đủ 6 vấn đề chính.
- Test có section solution tương ứng.
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message
- feat: strengthen homepage problem and solution storytelling
