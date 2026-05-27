# Task: Shop Small Pricing Page

## Status
completed

## Priority
high

## Objective
Tạo trang gói giá dành riêng cho chủ shop nhỏ/lẻ cần website giới thiệu, bán hàng đơn giản, landing page chốt đơn hoặc catalog sản phẩm.

## Requirements
- Route public `GET /pricing/shop`.
- Hiển thị các gói: giới thiệu cơ bản, catalog sản phẩm, bán hàng đơn giản.
- Mỗi gói có giá, quyền lợi, thời gian bàn giao, số lần chỉnh sửa.
- CTA yêu cầu báo giá hoặc đặt làm ngay.
- FAQ cho shop nhỏ.
- So sánh gói dễ hiểu.

## Files Expected
- `video-generator-app/app/Http/Controllers/ShopPricingController.php`
- `video-generator-app/resources/views/pricing/shop.blade.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/tests/Feature/ShopPricingPageTest.php`

## Implementation Notes
- Ưu tiên dùng `PricingPackage` có `audience_type=shop_owner`.
- Nếu package chưa có, fallback empty state/CTA.
- Không hard-code số điện thoại trong view nếu có config contact.

## Done When
- Chủ shop xem được gói giá phù hợp.
- CTA gửi báo giá hoạt động.
- FAQ shop nhỏ hiển thị.

## Test Requirements
- Test trang trả 200.
- Test hiển thị gói shop active.
- Test inactive package không hiển thị.
- Test CTA tới quote form.

## Suggested Git Commit Message
- `feat: add small shop pricing page`
