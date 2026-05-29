# Task: SEO Web Service Platform Positioning Audit

## Status
completed

## Priority
high

## Objective
Rà soát và điều chỉnh định vị của `seo-web-app` từ hướng marketplace/template sang nền tảng dịch vụ web, code, app, SEO và hỗ trợ kỹ thuật, nhưng vẫn tận dụng được các module source code, template và demo đã có.

## Requirements
- Audit toàn bộ public copy hiện tại ở homepage, services, pricing, source code, blog và CTA.
- Xác định rõ các nhóm dịch vụ chính:
  - SEO website
  - fix/chỉnh sửa giao diện website
  - tạo website và landing page
  - hỗ trợ đồ án sinh viên
  - nhận làm task lập trình
- Xác định rõ các nhóm khách hàng mục tiêu:
  - cá nhân
  - shop nhỏ
  - sinh viên
  - khách đã có website cần sửa
  - doanh nghiệp nhỏ
- Viết lại content architecture để toàn site dùng cùng một thông điệp chính, tránh lẫn giữa “bán template/source” và “nhận dịch vụ”.
- Cập nhật context nếu phạm vi hoặc cách gọi module thay đổi đáng kể.

## Files Expected
- `context/project-context.md`
- `context/decisions.md`
- `memory/progress.md`
- `memory/changelog.md`
- `seo-web-app/README.md`

## Implementation Notes
- Không cần thay schema ở task này.
- Ưu tiên chốt information architecture, copy strategy, terminology và route/content map trước khi sửa UI lớn.
- Nếu vẫn giữ module marketplace hiện có, phải mô tả rõ chúng đóng vai trò hỗ trợ funnel dịch vụ chứ không phải trọng tâm duy nhất.

## Done When
- Có định vị sản phẩm/dịch vụ rõ ràng, nhất quán và được ghi lại trong context.
- Có danh sách module public cần sửa tiếp theo theo đúng phạm vi user mô tả.
- Không còn mơ hồ giữa website “bán source/template” và website “cung cấp dịch vụ công nghệ”.

## Test Requirements
- Soát tay toàn bộ public route chính của `seo-web-app`.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- docs: align seo web app positioning around service platform
