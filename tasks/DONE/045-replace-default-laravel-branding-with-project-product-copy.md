# Task: Thay thế toàn bộ giá trị mặc định Laravel bằng tên dự án và sản phẩm

## Status
completed

## Priority
high

## Objective
Loại bỏ toàn bộ tên, title, metadata, copy, placeholder và branding mặc định của Laravel/template để thay bằng tên dự án, tên sản phẩm và nội dung phù hợp với SEO-web marketplace.

## Requirements
- Thay thế các giá trị mặc định Laravel trong:
  - `APP_NAME`
  - `<title>`
  - meta title/description
  - navigation brand
  - footer/copyright nếu có
  - auth pages
  - email/mail from name nếu có
  - README/setup docs liên quan app
  - seed data demo nếu đang dùng tên chung chung.
- Không để xuất hiện các cụm không phù hợp trên public UI:
  - `Laravel`
  - `Laravel News`
  - `Laracasts`
  - `Documentation`
  - `Example`
  - `Test User` trên UI public
  - `AI Video Generator` trong SEO-web app sau khi tách source.
- Tên dự án/sản phẩm nên thống nhất:
  - App/project: `SEO Web Marketplace` hoặc `Web Template Studio`.
  - Public brand: `Web Template Studio`.
  - Product lines: `Website cho shop nhỏ`, `Landing Page chốt đơn`, `Source Laravel đồ án`.
- Cập nhật `.env.example` đúng tên app.
- Cập nhật config nếu có:
  - `config/app.php`
  - `config/contact.php`
  - `config/seo.php` nếu tồn tại hoặc được tạo mới.
- Cập nhật auth/login/register UI để phù hợp admin/customer:
  - Login admin rõ ràng.
  - Không còn câu chữ "AI video workspace" trong SEO-web.
- Cập nhật browser title cho các page chính:
  - Trang chủ
  - Dịch vụ
  - Mẫu web
  - Gói giá
  - Source Laravel
  - Blog
  - Login/Admin

## Files Expected
- Nếu đã tách source:
  - `/seo-web-app/.env.example`
  - `/seo-web-app/config/app.php`
  - `/seo-web-app/resources/views/layouts/app.blade.php`
  - `/seo-web-app/resources/views/auth/login.blade.php`
  - `/seo-web-app/resources/views/auth/register.blade.php`
  - `/seo-web-app/resources/views/marketplace/**/*.blade.php`
  - `/seo-web-app/database/seeders/**/*.php`
  - `/seo-web-app/README.md`
  - `/seo-web-app/tests/Feature/*Branding*Test.php`
- Nếu chưa tách source, triển khai tạm trong:
  - `/video-generator-app/.env.example`
  - `/video-generator-app/config/app.php`
  - `/video-generator-app/resources/views/layouts/app.blade.php`
  - `/video-generator-app/resources/views/auth/login.blade.php`
  - `/video-generator-app/resources/views/auth/register.blade.php`
  - `/video-generator-app/resources/views/marketplace/**/*.blade.php`
  - `/video-generator-app/database/seeders/**/*.php`
  - `/video-generator-app/README.md`
  - `/video-generator-app/tests/Feature/*Branding*Test.php`

## Implementation Notes
- Dùng `rg "Laravel|Laracasts|Documentation|AI Video|Example|Test User"` để rà toàn bộ source.
- Với từ `Laravel`, không xóa khi nó là một phần sản phẩm thật như `Source Laravel đồ án`; chỉ xóa các dấu vết mặc định/framework không phục vụ nội dung bán hàng.
- Nếu repo đang có 2 app sau khi tách:
  - SEO-web không được còn branding video.
  - Video-generator vẫn có thể dùng `AI Video Generator`, nhưng không được còn marketplace copy ngoài ý muốn.
- Không sửa `.env` thật nếu có; chỉ sửa `.env.example`.
- Title/meta nên có keyword SEO tiếng Việt tự nhiên, không nhồi nhét.

## Done When
- Public SEO-web không còn nhận diện mặc định Laravel.
- Auth/admin SEO-web có tên dự án rõ ràng.
- `.env.example` dùng tên app đúng.
- Browser title các page chính đúng ngữ cảnh sản phẩm.
- Test branding pass.

## Test Requirements
- Feature test public pages không thấy copy mặc định Laravel.
- Feature test login page không thấy branding AI video trong SEO-web.
- Chạy:
  - `composer dump-autoload`
  - `php artisan test`
  - `npm run build`
- Browser smoke test kiểm tra title và header brand.

## Suggested Git Commit Message
- chore: replace default Laravel branding with seo web product copy
