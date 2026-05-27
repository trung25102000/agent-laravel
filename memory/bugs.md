# Bugs Log

Dùng file này để lưu các bug, lỗi môi trường, lỗi test, hoặc regression mà Codex gặp trong quá trình làm task.

## Format

- Ngày:
- Task:
- Bug:
- Nguyên nhân:
- Cách sửa:
- Trạng thái:

## Entries

- Ngày: 2026-05-28
- Task: post-027-audio-narration-fix
- Bug: Output có audio stream nhưng user vẫn không nghe được tiếng đúng kỳ vọng vì audio demo là tone placeholder, không phải narration/giọng đọc.
- Nguyên nhân: `DemoAudioTrackService` sinh sóng âm deterministic để tránh silent track nhưng chưa tạo tiếng đọc; âm thanh dễ bị hiểu là lỗi hoặc không phải voice-over.
- Cách sửa: Ưu tiên tạo narration `.aiff` bằng macOS `say` khi chạy local, giữ tone WAV fallback cho test/CI, thêm FFmpeg audio filter `apad,loudnorm`, render lại project `#6`.
- Trạng thái: Đã xử lý; output hiện có audio AAC 180s, max volume `-1.4 dB`, source asset `generated-voice.aiff`, mode `system_narration`.

- Ngày: 2026-05-28
- Task: 027-fix-audio-and-reference-based-xianxia-scenes
- Bug: Demo video project `#6` co MP4 playable nhung audio bi loi/khong nghe duoc vi pipeline co the tao fallback silent track.
- Nguyên nhân: FFmpeg fallback audio truoc do dung `anullsrc`; demo command chua tao audio asset that cho project.
- Cách sửa: Them `DemoAudioTrackService` sinh WAV nghe duoc bang song am deterministic, gan voice asset/audio metadata cho demo, doi FFmpeg fallback sang tone audible, probe audio stream/volume sau render, va render lai project `#6`.
- Trạng thái: Đã xử lý; ffprobe xác nhận output có video H.264 1080x1920 và audio AAC 180s, max volume `-14.3 dB`.

- Ngày: 2026-05-28
- Task: 026-xianxia-scene-character-demo-video
- Bug: Video demo xem được nhưng nội dung quá tĩnh, chưa thể hiện từng short/scene có nhân vật riêng.
- Nguyên nhân: FFmpeg fallback cũ chỉ tạo image nền đơn giản khi chưa có media AI thật.
- Cách sửa: Thêm command `demo:xianxia-review` tạo 6 scene review truyện tiên hiệp, sinh PNG nhân vật bằng GD cho từng scene, rồi render lại MP4 bằng FFmpeg provider.
- Trạng thái: Đã xử lý; project `#6` đã được thay bằng video review tiên hiệp 180 giây, 1080x1920.

- Ngày: 2026-05-27
- Task: 023-real-3-to-4-minute-video-rendering
- Bug: Máy local không có `ffmpeg` và `ffprobe` trong PATH; `brew install ffmpeg` bị kẹt khi build dependency `cmake` trên cấu hình macOS hiện tại.
- Nguyên nhân: Homebrew phải build từ source do cấu hình/tier hỗ trợ, quá lâu cho workflow hiện tại.
- Cách sửa: Dừng brew để tránh treo phiên, cài tạm binary qua npm `--no-save` trong `node_modules`, chmod `ffprobe`, rồi trỏ test/smoke render vào binary tạm để xác thực MP4 thật. Production vẫn dùng `FFMPEG_BINARY`/`FFPROBE_BINARY` hệ thống theo README.
- Trạng thái: Đã xử lý cho local validation; khi deploy cần cài FFmpeg hệ thống đúng chuẩn.

- Ngày: 2026-05-27
- Task: 001-project-foundation
- Bug: Local runtime chưa có PHP 8.5.
- Nguyên nhân: Máy hiện chạy PHP 8.4.7 qua Homebrew.
- Cách sửa: Bootstrap Laravel 13.11.2 với Composer constraint `php:^8.4` để dependency install và `php artisan test` chạy được; ghi workaround vào `context/decisions.md`.
- Trạng thái: Đã xử lý tạm thời, cần nâng runtime lên PHP 8.5 rồi đổi constraint về `php:^8.5` khi môi trường sẵn sàng.

- Ngày: 2026-05-27
- Task: 003-user-dashboard
- Bug: Feature test dashboard bị lỗi thiếu Vite manifest.
- Nguyên nhân: Test render layout có `@vite` nhưng asset frontend chưa được build trong môi trường test.
- Cách sửa: Gọi `$this->withoutVite()` trong dashboard feature test.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 017-error-handling-logging
- Bug: Render provider có thể throw raw infrastructure exception.
- Nguyên nhân: Trước task 017, `VideoRenderService` gọi provider trực tiếp và chưa map lỗi thành trạng thái pipeline an toàn.
- Cách sửa: Bọc render provider bằng try/catch, cập nhật project sang failed, log context an toàn, và throw `PipelineException`.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 019-security-review
- Bug: API/status trả `rendered_video_path`, làm lộ storage path nội bộ.
- Nguyên nhân: Resource/status payload ban đầu reuse field database cho response client.
- Cách sửa: Thay bằng `output_ready`, `preview_url`, `download_url`; thêm security tests.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-27
- Task: 019-security-review
- Bug: Middleware `throttle:api` được thêm nhưng limiter `api` chưa được định nghĩa trong skeleton.
- Nguyên nhân: Laravel 13 skeleton không có RateLimiter mặc định cho `api` trong app provider.
- Cách sửa: Định nghĩa `RateLimiter::for('api')` trong `AppServiceProvider`.
- Trạng thái: Đã xử lý, `php artisan test` pass.
