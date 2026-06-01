# Task: Clear Real Video Preview Player

## Status
completed

## Priority
critical

## Objective
Hoan thien trai nghiem xem truoc video sau khi video da duoc tao. Khi project co output MP4 that, user phai xem duoc video truc tiep tren trang preview bang player ro rang, dung ty le doc 9:16, co controls, metadata can thiet, va fallback download an toan.

## Requirements
- Trang `GET /video-projects/{videoProject}/preview` phai hien thi video player that khi project co file MP4 output.
- Player phai dung ty le 9:16, framed ro rang, khong chi hien text "Rendered video is ready".
- Video phai co controls native: play/pause, timeline, volume, fullscreen neu browser ho tro.
- Source video phai duoc phuc vu qua route/controller co authorization owner-only, khong expose raw internal storage path.
- Them route stream/inline video neu can, vi download route hien tai phu hop tai file nhung khong toi uu cho `<video src>`.
- Stream response phai dung MIME `video/mp4`, support range request neu kha thi de video seek/play tot trong browser.
- Neu output chua co, trang preview can co empty state ro va action quay lai progress.
- Neu output file path co trong DB nhung file bi mat, hien error state an toan, khong lo absolute path.
- Neu output la mock text file cu, preview khong duoc co gang render nhu video; phai hien state "output not playable" va goi y render lai bang FFmpeg/provider that.
- Hien metadata ro rang neu co:
  - duration
  - resolution
  - size
  - status
  - created/rendered time neu co
- Co nut Download video ro rang va nut Back to project.
- UI player phai responsive:
  - mobile: player full width, khong tran man hinh
  - desktop: player 9:16 nam canh metadata/action panel
- Khong de video element hoac text overlap.
- Authorization giu nguyen: non-owner khong xem preview, stream, download.
- API/status/resource khong duoc expose internal path.

## Files Expected
- `video-generator-app/app/Http/Controllers/VideoProjectPreviewController.php`
- `video-generator-app/routes/web.php`
- `video-generator-app/resources/views/video-projects/preview.blade.php`
- `video-generator-app/app/Models/VideoProject.php` neu can helper `isPlayableVideo`, `streamUrl`, metadata accessors
- `video-generator-app/tests/Feature/VideoProjectPreviewDownloadTest.php`
- co the them test rieng `VideoProjectVideoStreamTest.php`
- `.agents/context/routes-map.md`
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/context/decisions.md` neu chon cach stream/range

## Implementation Notes
- Uu tien tao route rieng:
  - `GET /video-projects/{videoProject}/stream`
  - middleware `auth`
  - policy `view`
  - tra inline video response cho `<video src="">`
- Neu dung `Storage::response`, kiem tra header/content-type co phu hop cho MP4. Neu can range request, co the dung `response()->stream()` hoac `BinaryFileResponse` voi header phu hop.
- File path trong DB phai la relative path va duoc doc qua configured disk.
- Chi cho play khi:
  - `rendered_video_path` khac null
  - file ton tai tren disk
  - extension/mime metadata la `mp4`/`video/mp4`
- Neu storage disk la local/private, khong public symlink truc tiep file private.
- Khong hard-code absolute local path vao view.
- Khong log output path absolute neu khong can; neu log, sanitize.
- Neu output metadata thieu, view van phai render dep voi fallback `Unknown`.
- Co the bo sung `poster` placeholder nhe bang CSS/HTML, khong can image asset moi neu chua co thumbnail.

## Done When
- User owner vao preview project completed co MP4 that va xem video truc tiep tren browser.
- Video player co `src` la route protected, khong phai storage path noi bo.
- User owner co the download video tu cung preview page.
- Project chua render hien empty state ro rang.
- Project co output missing/unplayable hien error state an toan.
- Non-owner bi `403` khi truy cap preview, stream, download.
- Tests pass cho owner preview player, stream response, missing output, unplayable output, non-owner access.
- Chay `composer dump-autoload`, `php artisan migrate`, `php artisan test`.

## Test Requirements
- Feature test owner xem preview cua MP4 completed thay `<video` va stream URL.
- Feature test stream route tra `200`, `Content-Type: video/mp4` hoac compatible, va khong la attachment download.
- Feature test non-owner truy cap stream bi forbidden.
- Feature test preview khi `rendered_video_path` null thay empty state.
- Feature test preview khi file missing thay error state, khong hien absolute path.
- Feature test output `.txt`/mock khong render player va hien not playable state.
- Feature test download route van hoat dong cho owner.
- Chay `php artisan test`.
