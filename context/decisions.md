# Decisions Log

File này dùng để ghi lại các quyết định kỹ thuật, assumptions, và workaround mà Codex tự đưa ra khi task chưa mô tả hết chi tiết nhưng vẫn đủ an toàn để tiếp tục.

## Format

- Ngày:
- Task:
- Loại: decision / assumption / workaround
- Nội dung:
- Lý do:
- Ảnh hưởng:

## Entries

- Ngày: 2026-05-27
- Task: 019-security-review
- Loại: decision
- Nội dung: API không trả `rendered_video_path`; thay vào đó trả `output_ready`, `preview_url`, và `download_url`.
- Lý do: Không expose storage path nội bộ cho client, kể cả relative path.
- Ảnh hưởng: Client phải dùng preview/download endpoint để truy cập output.

- Ngày: 2026-05-27
- Task: 014-admin-dashboard
- Loại: decision
- Nội dung: Admin MVP dùng một route `/admin` gộp users và video projects thay vì tách `/admin/users` và `/admin/video-projects`.
- Lý do: Task yêu cầu dashboard cơ bản; một route đủ cho giám sát nội bộ và giảm boilerplate trước khi chọn Filament hoặc admin UI riêng.
- Ảnh hưởng: Có thể tách route/resource admin sau khi nhu cầu quản trị lớn hơn.

- Ngày: 2026-05-27
- Task: 011-video-rendering-pipeline
- Loại: decision
- Nội dung: Render pipeline MVP dùng `MockRenderProvider` tạo output text file và `RenderVideoJob` queued.
- Lý do: Task yêu cầu mock output trước khi tích hợp FFmpeg thật, đồng thời giữ provider abstraction để task FFmpeg sau thay thế.
- Ảnh hưởng: `rendered_video_path` và output asset đã có contract; preview/download hiện sẽ xử lý file mock cho đến khi FFmpeg render thật được thêm.

- Ngày: 2026-05-27
- Task: 010-media-asset-selection
- Loại: decision
- Nội dung: Media asset MVP dùng placeholder text file lưu visual prompt thay vì ảnh/video thật.
- Lý do: Task hiện tại cần cấu trúc dữ liệu và storage path đủ cho pipeline/render mock; image/video AI thật sẽ thay thế provider ở phase sau.
- Ảnh hưởng: Render mock có thể đọc asset path; render FFmpeg thật sẽ cần image/video provider tạo binary media hợp lệ.

- Ngày: 2026-05-27
- Task: 008-voice-over-generation
- Loại: decision
- Nội dung: Mock TTS provider tạo file text trong storage thay vì audio binary thật.
- Lý do: MVP hiện cần kiểm chứng pipeline và lưu path/metadata trước khi tích hợp TTS thật; file text dễ test, deterministic, và không cần dependency audio.
- Ảnh hưởng: Render task sẽ cần adapter/mock render hiểu đây là artifact giả cho đến khi provider TTS thật được cấu hình.

- Ngày: 2026-05-27
- Task: 006-script-generation
- Loại: decision
- Nội dung: Script generation MVP chạy đồng bộ qua `ScriptGenerationService` và `ScriptGeneratorInterface`, dùng `MockScriptGenerator` theo config provider.
- Lý do: Task hiện tại cần provider abstraction và mock output trước khi tích hợp AI thật; queue orchestration sẽ được nối ở các task pipeline sau.
- Ảnh hưởng: Khi thêm OpenAI thật, chỉ cần bind provider mới cho `ScriptGeneratorInterface` và giữ service contract hiện tại.

- Ngày: 2026-05-27
- Task: 003-user-dashboard
- Loại: assumption
- Nội dung: Dashboard MVP nhận `videoProjects` là collection rỗng cho đến khi model `VideoProject` được tạo ở task 004.
- Lý do: Task 003 cho phép chuẩn bị khung view nếu chưa có model project hoàn chỉnh; tạo model ở task này sẽ chồng phạm vi với task 004.
- Ảnh hưởng: Test dashboard hiện kiểm tra auth, empty state, và link tạo video; test owner-scope với dữ liệu thật sẽ được bổ sung sau khi có model.

- Ngày: 2026-05-27
- Task: 001-project-foundation
- Loại: workaround
- Nội dung: Dùng Composer PHP constraint `php:^8.4` trong `video-generator-app/composer.json` thay vì `php:^8.5`.
- Lý do: Máy local hiện có PHP 8.4.7; nếu đặt `php:^8.5` thì không thể install dependency hoặc chạy `php artisan test`. Laravel 13.11.2 vẫn hỗ trợ PHP 8.4 và constraint `^8.4` vẫn cho phép chạy trên PHP 8.5 khi runtime được nâng cấp.
- Ảnh hưởng: Khi môi trường được nâng lên PHP 8.5, có thể đổi constraint về `php:^8.5` và chạy lại `composer update --lock`, `php artisan test`.

- Ngày: 2026-05-27
- Task: 001-project-foundation
- Loại: decision
- Nội dung: Queue mặc định trong `.env.example` đặt là Redis theo tech stack mục tiêu, trong khi `.env` local do Laravel skeleton tạo vẫn có thể dùng database/sync cho test nếu cần.
- Lý do: MVP production hướng đến Laravel Queue + Redis, còn test suite dùng `QUEUE_CONNECTION=sync` trong `phpunit.xml` để deterministic và không phụ thuộc Redis local.
- Ảnh hưởng: Khi deploy/staging cần cấu hình Redis thật và chạy worker queue `video`.

- Ngày: 2026-05-27
- Task: update project bootstrap directory
- Loại: decision
- Nội dung: Source Laravel chính sẽ được khởi tạo trong thư mục `video-generator-app/` thay vì đặt trực tiếp tại root repo.
- Lý do: Root repo đang là bộ điều khiển agent gồm rules, context, memory, prompts, và tasks; tách source ứng dụng giúp tránh trộn agent framework với Laravel runtime.
- Ảnh hưởng: Task foundation và các task code sau phải chạy Composer/Artisan/npm/test trong `video-generator-app/`.

- Ngày: 2026-05-27
- Task: update agent platform target
- Loại: decision
- Nội dung: Cập nhật bộ agent để mặc định làm việc với Laravel 13.x mới nhất và PHP 8.5 mới nhất; chỉ hạ xuống PHP 8.4/8.3 khi package hoặc môi trường bắt buộc.
- Lý do: Laravel 13 là nhánh tài liệu hiện tại, hỗ trợ PHP 8.3 - 8.5; PHP 8.5 là nhánh PHP mới nhất trên trang tải chính thức.
- Ảnh hưởng: Các task bootstrap và triển khai sau phải ưu tiên composer constraint `laravel/framework:^13.0` và `php:^8.5`, đồng thời tôn trọng skeleton Laravel hiện đại.

- Ngày: 2026-05-26
- Task: bootstrap autonomous agents system
- Loại: decision
- Nội dung: Khởi tạo đầy đủ bộ file rules, context, memory, prompts, và task mẫu để repo có thể vận hành theo mô hình task-driven cho Laravel.
- Lý do: Repo cần một nền tảng thống nhất để Codex có thể tự đọc, tự thực thi, và tự tiếp tục qua nhiều session.
- Ảnh hưởng: Các lần chạy sau chỉ cần thêm task vào `/tasks` và dùng prompt trong `/prompts`.

- Ngày: 2026-05-26
- Task: 000-project-overview
- Loại: assumption
- Nội dung: Chọn Blade + web routes chuẩn Laravel làm hướng MVP ban đầu, đồng thời giữ API nội bộ và provider interface để các tích hợp AI/TTS/render thật có thể thay vào sau.
- Lý do: Repo chưa có source code Laravel, nên cần một hướng triển khai rõ ràng, ít phụ thuộc, và phù hợp backlog hiện tại.
- Ảnh hưởng: Các task tiếp theo sẽ ưu tiên bootstrap một web app Laravel truyền thống trước, thay vì chọn SPA stack phức tạp hơn.

- Ngày: 2026-05-26
- Task: 000-project-overview
- Loại: decision
- Nội dung: Ghi rõ trong context rằng repo hiện chưa có source Laravel và việc khởi tạo framework là điều kiện tiên quyết cho task kỹ thuật tiếp theo.
- Lý do: Điều này phản ánh trạng thái thực tế của workspace và giúp phân biệt blocker môi trường với lỗi triển khai.
- Ảnh hưởng: Task 001 sẽ phải xác minh khả năng khởi tạo Laravel trước khi tiếp tục các module sản phẩm.
