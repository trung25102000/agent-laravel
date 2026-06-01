# Task: UX Writing Review And Content Optimization

## Status
completed

## Priority
high

## Objective

Review và tối ưu toàn bộ text hiển thị trên website dưới góc nhìn khách hàng, loại bỏ ngôn ngữ kỹ thuật hoặc developer-centric, đồng thời thay bằng nội dung dễ hiểu, đúng ngữ cảnh và hỗ trợ chuyển đổi tốt hơn.

## Requirements

- Review toàn bộ text hiển thị cho người dùng trên:
  - Home Page
  - Service Page
  - Portfolio Page
  - Contact Page
  - Form gửi yêu cầu
  - Header
  - Footer
  - CTA Buttons
  - Empty States
  - Error Messages
  - Success Messages
  - Modal
  - Dialog
  - Notification
  - Validation Messages
- Loại bỏ hoặc thay thế các nội dung:
  - mang tính kỹ thuật
  - mang ngôn ngữ developer
  - khó hiểu
  - không đúng ngữ cảnh
  - không tạo giá trị cho khách hàng
  - không hỗ trợ chuyển đổi
- Ưu tiên tiếng Việt tự nhiên, rõ lợi ích và dễ hành động.
- Đồng nhất tone & voice cho toàn bộ public-facing content.

## Subtasks

- Audit toàn bộ text hiện tại đang hiển thị cho người dùng.
- Phân loại text theo các nhóm vấn đề:
  - text mang tính developer
  - text quá chung chung
  - text không mang lại giá trị
  - text quá dài
  - text không phù hợp đối tượng khách hàng
- Chuyển các heading/copy từ hướng feature sang benefit khi phù hợp.
- Audit toàn bộ CTA button và thay bằng hành động rõ ràng hơn.
- Audit riêng Hero Section:
  - độ rõ ràng
  - mức độ giải thích dịch vụ
  - độ phù hợp với đối tượng
  - mức độ tạo động lực liên hệ
- Audit form:
  - label
  - placeholder
  - validation messages
  - submit button
- Tạo báo cáo `tasks/content-review-report.md`.
- Thực hiện chỉnh sửa toàn bộ text chưa phù hợp.
- Đồng bộ lại test nếu contract nội dung public thay đổi.

## Files Expected

- `tasks/content-review-report.md`
- `seo-web-app/resources/views/**/*.blade.php`
- `seo-web-app/resources/js/**/*.js`
- `seo-web-app/app/Http/Requests/**/*.php`
- `seo-web-app/app/Http/Controllers/**/*.php`
- `seo-web-app/lang/**/*.php`
- `seo-web-app/tests/Feature/**/*.php`

## Implementation Notes

- Mục tiêu cuối cùng: người dùng đọc phải hiểu ngay có thể nhờ dịch vụ này làm website, SEO, sửa lỗi hoặc hỗ trợ lập trình.
- Không giữ text kiểu dashboard/admin nếu nó đang xuất hiện trên phần public site.
- Ưu tiên wording theo benefit:
  - rõ đầu ra
  - rõ lợi ích
  - rõ hành động tiếp theo
- Không tối ưu theo hướng buzzword hoặc “platform/system/solution” chung chung.
- Với các đoạn quá dài:
  - rút xuống còn dễ đọc trên mobile
  - ưu tiên câu ngắn, trực tiếp

## Done When

- Có báo cáo `tasks/content-review-report.md` hoàn chỉnh.
- Toàn bộ text public-facing chính đã được review và chỉnh sửa theo tone mới.
- CTA rõ hành động hơn.
- Hero, form, empty state, success/error/validation messages đã dùng ngôn ngữ tự nhiên hơn.
- Ngôn ngữ toàn site nhất quán hơn, ít mang tính kỹ thuật hơn.
- Test pass và build pass nếu task chạm frontend/public contract.

## Test Requirements

- `composer dump-autoload`
- `php artisan migrate`
- `php artisan test`
- `npm run build`

## Suggested Git Commit Message

- feat: improve ux writing across public website
