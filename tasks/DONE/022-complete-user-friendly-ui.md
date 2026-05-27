# Task: Complete User Friendly UI

## Status
completed

## Priority
high

## Objective
Hoan thien giao dien web cho nen tang tao video AI de nguoi dung moi co the tao, theo doi, preview, va quan ly video mot cach de hieu, than thien, va it bi loi thao tac.

## Requirements
- Thiet ke lai flow chinh tu dashboard den tao project, chon template, preview script, theo doi progress, preview/download video.
- Giao dien phai responsive tot tren desktop va mobile.
- Form tao video phai ro rang, co helper text ngan gon, validation message than thien, va gia tri mac dinh hop ly.
- Trang show/progress phai hien thi trang thai pipeline theo tung buoc: script, scene, media, voice, subtitle, render, finalize.
- Trang preview/download phai co empty state, loading state, error state, va completed state.
- Dashboard phai giup user scan nhanh cac video gan day, status, thoi luong, ngon ngu, template, va action tiep theo.
- Admin UI neu co phai de quan sat tong quan project/job loi, nhung khong lam lo thong tin nhay cam.
- Khong dua text huong dan qua dai vao UI; uu tien label, icon, status, tooltip ngan, va bo cuc de tu hieu.
- Giu controller mong; logic format du lieu phuc vu UI nen nam trong model accessor, resource/view model, service nho, hoac helper phu hop.

## Files Expected
- `video-generator-app/resources/views/layouts/app.blade.php`
- `video-generator-app/resources/views/dashboard.blade.php`
- `video-generator-app/resources/views/video-projects/create.blade.php`
- `video-generator-app/resources/views/video-projects/show.blade.php`
- `video-generator-app/resources/views/video-projects/preview.blade.php`
- `video-generator-app/resources/views/admin/dashboard.blade.php`
- `video-generator-app/resources/css/app.css`
- controller/request/resource lien quan neu can bo sung data cho UI
- feature tests cho cac trang UI chinh
- `memory/progress.md`
- `memory/changelog.md`
- `context/decisions.md` neu co quyet dinh UI/UX dang chu y

## Implementation Notes
- Uu tien Blade + Vite hien co, khong them frontend framework moi neu khong that can.
- Co the bo sung component Blade tai `resources/views/components` neu lap lai nhieu UI pattern.
- Can dam bao text khong tran layout o mobile, nut/action co kich thuoc de bam, va cac trang quan trong khong bi card long nhau.
- Nen dung badge/status color nhat quan cho `VideoProjectStatusEnum`.
- Neu can icon, dung SVG inline toi gian hoac package co san; khong them dependency nang chi vi icon.

## Done When
- User co the tao project moi, xem progress, preview/download, va quay lai dashboard ma khong can doc tai lieu rieng.
- UI hoat dong tot o mobile va desktop.
- Tat ca route web chinh render thanh cong voi user da login.
- Validation/error/empty/loading/completed states duoc xu ly ro rang.
- Test pass.
- Khong vi pham rules frontend, security, authorization, va Laravel convention.

## Test Requirements
- Feature test dashboard render danh sach project va empty state.
- Feature test form create hien validation message than thien khi input sai.
- Feature test show/progress render dung cac status pipeline.
- Feature test preview/download page khong loi khi project chua co output va khi da co output.
- Chay `php artisan test`.
