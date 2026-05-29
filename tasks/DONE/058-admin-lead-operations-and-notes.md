# Task: Admin Lead Operations And Notes

## Status
completed

## Priority
medium

## Objective
Nâng cấp dashboard admin để quản lý lead dịch vụ tốt hơn: xem nhanh nhu cầu, phân loại, cập nhật trạng thái và lưu note tư vấn nội bộ.

## Requirements
- Rà soát các module admin hiện có cho:
  - order requests
  - quote requests
  - graduation project requests
  - contact messages
  - customers
- Thêm hoặc chuẩn hóa:
  - trạng thái xử lý
  - note nội bộ
  - service type / lead source
  - độ ưu tiên
  - action link để liên hệ nhanh
- Dashboard admin nên có overview các lead mới/chưa xử lý.
- Query/filter/sort phải hữu ích cho workflow tư vấn thực tế.

## Files Expected
- `seo-web-app/resources/views/admin/marketplace/dashboard.blade.php`
- `seo-web-app/resources/views/admin/marketplace/orders.blade.php`
- `seo-web-app/resources/views/admin/marketplace/quotes.blade.php`
- `seo-web-app/resources/views/admin/marketplace/graduation-requests.blade.php`
- `seo-web-app/resources/views/admin/marketplace/contacts.blade.php`
- `seo-web-app/app/Http/Controllers/Admin/*`
- `seo-web-app/tests/Feature/AdminLeadOperationsTest.php`

## Implementation Notes
- Admin note không được public ra frontend.
- Nếu thêm cột DB, migration phải reversible.
- Tránh biến admin thành CRM quá lớn; chỉ tập trung vào workflow thực tế hiện tại.

## Done When
- Admin có thể theo dõi và xử lý lead thuận tiện hơn rõ rệt.
- Các listing chính có state/note/filter cần thiết.

## Test Requirements
- Test admin listing/filter/update note/status.
- Test non-admin forbidden.
- Chạy trong `seo-web-app`:
  - `php artisan test`

## Suggested Git Commit Message
- feat: improve admin lead operations
