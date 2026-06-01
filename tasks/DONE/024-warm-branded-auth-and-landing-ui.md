# Task: Warm Branded Auth And Landing UI

## Status
completed

## Priority
high

## Objective
Hoan thien giao dien theo huong co mau sac than thien, de gan, ro rang cho user moi. Thay toan bo title/copy con mang tinh mac dinh Laravel thanh ngon ngu lien quan den nen tang tao video AI. Page dau tien phai dan user den man login/dang ky mot cach tu nhien, va man login phai co giao dien day du, de hieu, de thao tac.

## Requirements
- Doi `APP_NAME` mac dinh neu can trong `.env.example`/view title/copy de khong con cam giac "Laravel" mac dinh.
- Trang `/` khong duoc la welcome page mac dinh cua Laravel.
- Trang `/` phai la entry page gon, ro rang, co nhan dien san pham AI Video Generator va CTA di den `login`/`register`.
- Page dau can co mau sac than thien, de gan, khong lanh/qua ky thuat, khong doc mot mau; uu tien palette sang, hien dai, co contrast tot.
- Tat ca title, heading, subtitle, button, empty state lien quan phai dung ngon ngu cua san pham: AI video, short-form video, TikTok/Reels/Shorts, script, render, project, workspace.
- Khong con cac text mac dinh nhu `Laravel`, `Dashboard` vo nghia, `Sign in` qua thuan ky thuat neu co the viet gan voi san pham hon.
- Login page phai co layout ro rang:
  - brand/product signal noi bat
  - form email/password de nhin
  - validation error de doc
  - remember checkbox gon
  - CTA login noi bat
  - link dang ky tai khoan
  - link quay lai page dau neu phu hop
  - copy ngan ve loi ich san pham
- Register page nen dong bo phong cach voi login page, khong bi lech giao dien.
- Navigation trong layout app phai co label than thien va khong gay nham lan giua guest/auth.
- UI phai responsive tren mobile va desktop.
- Khong dung gradient/orb/bokeh trang tri lan man; mau sac phai phuc vu doc/scan/action.
- Khong them frontend framework moi neu Blade + Tailwind/Vite hien tai dap ung duoc.

## Files Expected
- `video-generator-app/resources/views/welcome.blade.php`
- `video-generator-app/resources/views/auth/login.blade.php`
- `video-generator-app/resources/views/auth/register.blade.php`
- `video-generator-app/resources/views/layouts/app.blade.php`
- `video-generator-app/resources/views/dashboard.blade.php` neu can doi heading/copy mac dinh
- `video-generator-app/resources/css/app.css`
- `.env.example` neu can doi default `APP_NAME`
- feature tests cho welcome/login/register UI
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/context/routes-map.md` neu thay doi mo ta route
- `.agents/context/decisions.md` neu co quyet dinh branding/palette dang chu y

## Implementation Notes
- Uu tien Blade + Tailwind utility classes da co.
- Nen tao page welcome rieng bang layout app hoac layout guest gon, nhung khong copy welcome Laravel mac dinh.
- Mau sac goi y: nen trang/near-white, text zinc/neutral, accent xanh la/teal/sky/amber dung vua phai; tranh theme toan slate/dark, toan beige, hoac toan purple.
- Copy nen ngan, ro, de doc bang tieng Anh hoac tieng Viet nhat quan voi app hien tai. Neu app hien dang dung English UI, tiep tuc English nhung noi dung phai branded.
- Form fields can co `id`, `label`, autocomplete phu hop, focus state ro, va error message sat field.
- Button/action phai co kich thuoc de bam tren mobile.
- Khong expose route/file/storage noi bo.
- Khong viet business logic trong view; view chi render data va route.

## Done When
- Truy cap `/` khong con thay Laravel welcome mac dinh.
- User co the tu page dau di den login/register ro rang.
- Login page co giao dien branded, than thien, validation ro rang, responsive.
- Register page dong bo voi login page.
- Title/headings/copy chinh khong con mac dinh Laravel va lien quan truc tiep den AI video generator.
- Mau sac UI than thien, de gan, contrast tot, khong gay roi mat.
- Feature tests pass cho welcome/login/register.
- Chay `composer dump-autoload`, `php artisan migrate`, `php artisan test`.
- Neu sua asset/CSS, chay `npm run build`.

## Test Requirements
- Feature test guest xem `/` thay ten san pham va CTA login/register, khong thay Laravel default welcome copy.
- Feature test guest xem `/login` thay branded login copy, email/password fields, register link.
- Feature test login validation error render ro rang.
- Feature test guest xem `/register` thay branded register copy.
- Feature test authenticated user vao `/` co duong di hop ly den dashboard hoac dashboard CTA.
- Chay `php artisan test`.
