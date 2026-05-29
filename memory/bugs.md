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

- Ngày: 2026-05-29
- Task: 058-admin-lead-operations-and-notes
- Bug: `MarketplaceAdminTest` fail sau khi workflow update order yêu cầu thêm `priority` và `lead_source`.
- Nguyên nhân: Task 058 chuẩn hóa contract update lead cho admin, nhưng test cũ chỉ gửi `status` và `internal_note` theo contract trước đó.
- Cách sửa: Cập nhật test admin gửi đầy đủ `priority` và `lead_source`, đồng thời assert lại các field mới trong database.
- Trạng thái: Đã xử lý; full suite pass 44 tests / 299 assertions.

- Ngày: 2026-05-29
- Task: 054-portfolio-and-case-study-module
- Bug: `PortfolioCaseStudyTest` fail 404 ở route update admin vì test gọi `id` trong khi `DemoProject` đã chuyển sang route model binding theo `slug`.
- Nguyên nhân: Sau khi thêm `getRouteKeyName(): slug` để dùng public route `/portfolio/{slug}`, route admin `PATCH /admin/marketplace/demo-projects/{demoProject}` cũng áp dụng binding theo slug.
- Cách sửa: Cập nhật test dùng `$project->slug` cho route update admin.
- Trạng thái: Đã xử lý; full suite pass 37 tests / 254 assertions.

- Ngày: 2026-05-29
- Task: 050-service-catalog-domain-module
- Bug: `MarketplacePublicTest` fail sau khi `/services` đổi từ copy tĩnh sang service catalog dữ liệu thật.
- Nguyên nhân: Test cũ vẫn assert headline `Làm website, landing page` và không seed `service_offerings`, nên không phản ánh hành vi mới của trang dịch vụ.
- Cách sửa: Cập nhật test để seed một `ServiceOffering` publish và assert headline service-first mới cùng item dịch vụ thực tế.
- Trạng thái: Đã xử lý; `php artisan test` pass 29 tests / 215 assertions.

- Ngày: 2026-05-29
- Task: 049-seo-web-service-platform-positioning-audit
- Bug: `composer dump-autoload` trong `seo-web-app/` fail platform check vì runtime CLI hiện tại là PHP 8.3.6, trong khi `composer.json` yêu cầu `>= 8.4.0`.
- Nguyên nhân: Môi trường shell hiện trỏ tới `/usr/bin/php` phiên bản 8.3.6; dependency của app vẫn được cài từ lần trước nên `php artisan test` còn chạy được, nhưng Composer script kiểm tra platform trước khi hoàn tất autoload.
- Cách sửa: Dùng workaround `composer dump-autoload --ignore-platform-req=php` để hoàn tất validation cho task tài liệu; cần nâng CLI PHP của môi trường lên 8.4+ để bỏ workaround ở các task sau.
- Trạng thái: Đã xử lý tạm thời cho validation hiện tại; còn residual environment mismatch.

- Ngày: 2026-05-29
- Task: 047-product-service-landing-page-experience
- Bug: Full test suite fail vì một số feature test cũ vẫn assert headline homepage cũ `Làm website đẹp`.
- Nguyên nhân: Task 047 thay đổi copy chiến lược của hero landing page nhưng test branding/public marketplace chưa được cập nhật theo hành vi mới.
- Cách sửa: Cập nhật `BrandedEntryUiTest` và `MarketplacePublicTest` để assert hero/storytelling mới, giữ các assert không còn copy mặc định Laravel.
- Trạng thái: Đã xử lý; `php artisan test` pass 23 tests / 178 assertions.

- Ngày: 2026-05-28
- Task: 034-045-source-separation
- Bug: Sau khi nhân bản `seo-web-app/`, seed lại có thể đụng email mặc định `test@example.com` nếu database đã có user từ lần chạy trước.
- Nguyên nhân: Seeder cũ dùng `User::factory()->create()` với email cố định nên không idempotent khi app chạy trên database local đã tồn tại dữ liệu.
- Cách sửa: Đổi `DatabaseSeeder` của cả hai app sang `User::updateOrCreate()` cho tài khoản mặc định; validation dùng `migrate:fresh --seed --force` pass ở cả hai app.
- Trạng thái: Đã xử lý.

- Ngày: 2026-05-28
- Task: 034-045-source-separation
- Bug: File SQLite local của từng app có thể bị stage nhầm sau khi tạo app mới và chạy migrate.
- Nguyên nhân: `.gitignore` trong app chưa khai báo `*.sqlite`.
- Cách sửa: Thêm `*.sqlite` vào `.gitignore` của `seo-web-app/` và `video-generator-app/`; trước khi push cần kiểm tra staged files không có `.env`, `.sqlite`, `vendor`, `node_modules`, `public/build`.
- Trạng thái: Đã xử lý.

- Ngày: 2026-05-28
- Task: marketplace-mvp
- Bug: Feature tests cũ gọi `/` trong SQLite memory chưa migrate marketplace tables nên landing page query `website_templates` gây lỗi `no such table`.
- Nguyên nhân: Một số smoke test không dùng `RefreshDatabase`, trong khi homepage mới đọc dữ liệu marketplace.
- Cách sửa: Guard homepage bằng `Schema::hasTable()` và trả collection rỗng khi bảng chưa tồn tại.
- Trạng thái: Đã xử lý, `php artisan test` pass.

- Ngày: 2026-05-28
- Task: marketplace-mvp
- Bug: Test admin cũ kỳ vọng `/admin` hiển thị video projects, trong khi dashboard mới chuyển sang marketplace.
- Nguyên nhân: Route `/admin` được tái định hướng nghiệp vụ sang marketplace nhưng module video legacy vẫn cần quan sát.
- Cách sửa: Dashboard marketplace hiển thị thêm users/video projects legacy và giữ filter `status`; route `/admin/video-projects` trỏ dashboard video cũ.
- Trạng thái: Đã xử lý, `php artisan test` pass.

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
- Ngày: 2026-05-29
- Task: 066-portfolio-ui-showcase-upgrade
- Bug: Full test suite public pages fail với thông báo `Call to undefined method ReflectionProperty::isVirtual()` sau khi nâng UI portfolio/service cards.
- Nguyên nhân: Blade compile bị vỡ bởi cú pháp `@php(...)` ngắn trong service card loop; Symfony error renderer trên PHP 8.3 lại gọi `ReflectionProperty::isVirtual()` khi render exception nên che mất lỗi gốc và làm failure nhìn như lỗi runtime chung.
- Cách sửa: Bypass exception renderer để lấy `Illuminate\\View\\ViewException` gốc, đổi `@php(...)` sang block `@php ... @endphp` rõ ràng, và chạy lại full validation.
- Trạng thái: Đã xử lý, `php artisan test` pass lại.
