# Task: Di chuyển domain seo-web sang app riêng

## Status
completed

## Priority
high

## Objective
Copy/move toàn bộ code marketplace SEO-web từ `video-generator-app` sang `seo-web-app`, để website bán template/dịch vụ/source Laravel chạy độc lập.

## Requirements
- Chuyển các model marketplace sang `seo-web-app`:
  - `TemplateCategory`
  - `WebsiteTemplate`
  - `PricingPackage`
  - `Customer`
  - `OrderRequest`
  - `QuoteRequest`
  - `GraduationProjectRequest`
  - `ContactMessage`
  - `BlogPost`
  - `SourceCodeProduct`
  - `DemoProject`
  - `ProductAttachment`
  - `FaqItem`
- Chuyển controllers:
  - `MarketplaceController`
  - `Admin\MarketplaceAdminController`
- Chuyển FormRequests:
  - `StoreOrderRequestRequest`
  - `StoreQuoteRequestRequest`
  - `StoreGraduationProjectRequestRequest`
  - `StoreContactMessageRequest`
- Chuyển services:
  - `CustomerUpsertService`
- Chuyển config:
  - `config/contact.php`
- Chuyển views:
  - `resources/views/marketplace/**`
  - `resources/views/admin/marketplace/**`
  - component liên quan: `contact-cta`, `faq-list`, `template-card`, admin table/simple-create.
- Chuyển marketplace routes public/admin sang `seo-web-app/routes/web.php`.
- Đảm bảo route names không phụ thuộc video routes.

## Files Expected
- `/seo-web-app/app/Models/*`
- `/seo-web-app/app/Http/Controllers/MarketplaceController.php`
- `/seo-web-app/app/Http/Controllers/Admin/MarketplaceAdminController.php`
- `/seo-web-app/app/Http/Requests/*`
- `/seo-web-app/app/Services/CustomerUpsertService.php`
- `/seo-web-app/config/contact.php`
- `/seo-web-app/resources/views/marketplace/**`
- `/seo-web-app/resources/views/admin/marketplace/**`
- `/seo-web-app/resources/views/components/**`
- `/seo-web-app/routes/web.php`

## Implementation Notes
- Ưu tiên copy sang app mới trước, sau đó test app mới, rồi mới xóa khỏi video app ở task riêng.
- Không để `seo-web-app` import class video như `VideoProject`, `RenderVideoJob`, `VideoProjectStatusEnum`.
- Admin dashboard SEO-web chỉ hiển thị số liệu marketplace, không hiển thị video projects.
- Các route protected admin dùng `auth` + gate/policy admin riêng của seo-web.

## Done When
- `seo-web-app` có đầy đủ public marketplace.
- Các form order/quote/contact/graduation request lưu DB đúng.
- Admin marketplace đăng nhập được và xem quản lý module chính.
- Không còn class reference tới domain video trong `seo-web-app`.

## Test Requirements
- Feature test public marketplace pages.
- Feature test public form submissions.
- Feature test admin access/admin CRUD tối thiểu.
- `php artisan test` pass trong `/seo-web-app`.

## Suggested Git Commit Message
- feat: extract seo web marketplace domain into standalone app
