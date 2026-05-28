# Changelog

## 2026-05-29

- Hoàn tất task `048-visual-problem-story-carousel`: thay section vấn đề trên homepage `seo-web-app` bằng carousel storytelling 4 nhóm khách hàng với visual mockup, problem/solution cards, CTA, controls, auto-play, pause on hover/focus và reduced-motion support.
- Thêm `ProblemStoryCarouselTest` kiểm tra marker carousel, nội dung vấn đề chính và asset JS/CSS; full suite SEO app pass 26 tests / 204 assertions, Vite build, Pint và browser smoke test pass.
- Hoàn tất task `047-product-service-landing-page-experience`: tái cấu trúc homepage `seo-web-app` thành landing page sản phẩm/dịch vụ với hero mới, section vấn đề người dùng, section giá trị/giải pháp, audience, demo, process, trust, pricing và CTA.
- Thêm `LandingPageExperienceTest`, cập nhật tests public/branding theo copy mới; full suite SEO app pass 23 tests / 178 assertions, Vite build và Pint pass.
- Hoàn tất task `046-animated-trust-building-visuals`: thêm hero mockup động bằng HTML/CSS, trust badges, motion cards, scroll reveal bằng IntersectionObserver, CTA micro-interactions và reduced-motion support cho `seo-web-app`.
- Bổ sung `AnimatedTrustVisualsTest` kiểm tra trust badges, marker visual/reveal và asset CSS/JS; full suite SEO app pass 20 tests / 153 assertions, build Vite pass.

## 2026-05-28

- Tách repo thành hai ứng dụng Laravel độc lập: `seo-web-app/` cho Web Template Studio marketplace và `video-generator-app/` cho AI Video Generator.
- Làm sạch domain trong từng app: SEO app giữ marketplace/service/source-code/blog/admin lead modules; video app giữ pipeline tạo video, preview, stream/download và admin video.
- Cập nhật branding/giao diện SEO app theo hướng landing page trẻ trung, thân thiện, nhắm shop nhỏ, cá nhân kinh doanh online và sinh viên; loại bỏ copy/template Laravel mặc định trên landing, auth, docs và config.
- Cập nhật README root, README từng app, project context, routes map, database schema và source separation decision/plan cho kiến trúc hai app.
- Chạy validation sau split: `seo-web-app/` pass 17 tests / 124 assertions + build + Pint; `video-generator-app/` pass 62 tests / 320 assertions + build + Pint.
- Smoke test browser SEO app tại `http://127.0.0.1:8010` pass cho landing, services, templates, shop pricing, source code, blog, login, sitemap và robots.
- Triển khai Web Template Studio marketplace MVP: public pages homepage/services/templates/pricing/source-code/blog, lead/order/contact/graduation forms, admin marketplace dashboard và CRUD cơ bản.
- Thêm database module marketplace gồm template categories, website templates, pricing packages, customers, order requests, quote requests, graduation project requests, contact messages, blog posts, source code products, demo projects, product attachments, FAQ.
- Bổ sung UI trẻ trung thân thiện với palette rose/amber/sky, CTA Zalo/Facebook/Email, nội dung theo 3 nhóm khách hàng: shop nhỏ, cá nhân kinh doanh online, sinh viên.
- Thêm MarketplaceSeeder, AdminUserSeeder, feature tests public/form/admin/SEO, cập nhật docs context/routes/schema/memory.
- Hoàn tất task `027-fix-audio-and-reference-based-xianxia-scenes`: thêm generated WAV audio nghe được cho demo tiên hiệp, FFmpeg output probe audio metadata, fallback audio không còn dùng `anullsrc`, và preview project `#6` có Audio Ready.
- Render lại project `#6` với reference URL YouTube được lưu trong metadata, visual source `reference_inspired_original`, output MP4 180 giây có video H.264 1080x1920 và audio AAC.
- Sửa tiếp demo audio để ưu tiên system narration `.aiff` bằng macOS `say` khi chạy local, normalize/pad bằng FFmpeg, và render lại project `#6` với audio AAC max volume `-1.4 dB`.
- Thêm task pending `027-fix-audio-and-reference-based-xianxia-scenes` ưu tiên cao để sửa audio output, xác thực audio stream bằng FFprobe, và nâng cấp visual nhân vật từng scene theo reference YouTube an toàn bản quyền.
- Thêm task `026-xianxia-scene-character-demo-video` để sửa demo video tĩnh bằng video review truyện tiên hiệp có nhân vật riêng cho từng scene.
- Thêm command `demo:xianxia-review`, service tạo demo project/scenes/PNG character assets bằng GD, option `--skip-render` cho test, và feature tests cho command.
- Render lại project preview `#6` thành MP4 180 giây, 1080x1920, chủ đề `Review truyện tiên hiệp: Kiếm Đạo Trường Sinh`, xem qua protected stream route.

## 2026-05-27

- Bổ sung backlog mới gồm `024-warm-branded-auth-and-landing-ui` cho landing/login/register branded, màu sắc thân thiện, bỏ copy Laravel mặc định và `025-clear-real-video-preview-player` cho preview MP4 thật bằng player protected.
- Hoàn thiện landing page, login, register, navigation, và dashboard copy theo nhận diện AI Video Generator với palette teal/amber/sky thân thiện; thay welcome page mặc định và thêm branded UI tests.
- Thêm protected inline MP4 stream route cho preview player 9:16, metadata duration/resolution/size, safe states cho output missing/unplayable, và tests owner/non-owner preview/stream/download.
- Bổ sung backlog mới gồm `022-complete-user-friendly-ui` cho giao diện hoàn chỉnh, thân thiện, dễ dùng và `023-real-3-to-4-minute-video-rendering` cho render MP4 thật dài 3-4 phút bằng FFmpeg.
- Hoàn thiện UI web chính gồm layout app, dashboard thống kê, form tạo video, trang progress/scene/script, preview/download states, admin dashboard, status labels, và feature tests UI.
- Thêm FFmpeg render provider thật bật bằng `VIDEO_RENDER_PROVIDER=ffmpeg`, fallback JPEG/audio/subtitle hợp lệ, render metadata, migration output metadata, duration 3-4 phút, README env vận hành, và tests command/failure/integration MP4.
- Xác thực render thật bằng smoke project tạo output MP4 180 giây, 1080x1920, lưu tại storage local.
- Cập nhật bộ agent/rules/context để mặc định làm việc với Laravel 13.x và PHP 8.5.
- Thêm `rules/platform-version-rules.md` làm luật nền cho Composer constraint, skeleton Laravel 13, Vite, API routing, và style PHP 8.5.
- Cập nhật prompt start/continue/review và các task foundation, auth, API để tránh giả định Laravel 11/12 hoặc cấu trúc legacy.
- Bắt buộc bootstrap source Laravel trong `video-generator-app/`, giữ root repo cho bộ agent/rules/tasks/context.
- Thêm master plan chi tiết cho nền tảng tạo video AI gồm product requirements, database, architecture, pipeline, API, queue jobs, FFmpeg, AI prompts, testing, deployment, roadmap, và task table.
- Bootstrap Laravel 13.11.2 trong `video-generator-app/`, thêm `config/video_pipeline.php`, cập nhật `.env.example` cho Redis/storage/mock AI/TTS/render providers, tạo storage directories nền tảng, và thêm smoke test foundation.
- Triển khai auth thủ công gồm register/login/logout, FormRequest validation, login throttling, protected dashboard/video project create routes, `users.is_admin`, Blade auth views, và feature tests.
- Thêm `DashboardController`, dashboard MVP có empty state và link tạo video, cùng feature tests cho guest redirect và authenticated dashboard.
- Thêm `VideoProject` model, `VideoProjectStatusEnum`, migration `video_projects`, factory, owner relationship/policy, show placeholder route, và dashboard owner-scoped listing.
- Thêm `VideoProjectController`, `StoreVideoProjectRequest`, form tạo video project draft, route store, và feature tests cho form/create/validation.
- Thêm `ScriptGeneratorInterface`, `MockScriptGenerator`, `ScriptGenerationResult`, `ScriptGenerationService`, binding provider mock, và unit test lưu script/status/progress.
- Thêm `VideoScene`, `VideoSceneStatusEnum`, migration/factory scenes, `SceneGenerationService`, quan hệ ordered scenes, và tests tách/lưu scene.
- Thêm `TextToSpeechInterface`, `MockTextToSpeechProvider`, `GeneratedAudio`, `VoiceOverGenerationService`, audio fields trên `video_projects`, và test lưu file/path voice-over.
- Thêm `SubtitleGenerationService`, subtitle fields trên `video_projects`, SRT writer từ scene timings, và test lưu file/path subtitle.
- Thêm `VideoAsset`, `VideoAssetTypeEnum`, migration/factory assets, relationships project/scene assets, `MediaAssetSelectionService`, và test placeholder asset selection.
- Thêm `RenderProviderInterface`, `MockRenderProvider`, `RenderedVideo`, `VideoRenderService`, `RenderVideoJob`, output asset creation, và tests render/job.
- Thêm `VideoProjectStatusService`, status JSON endpoint owner-only, và tests cập nhật/xem/chặn status project.
- Thêm `VideoProjectPreviewController`, preview/download routes owner-only, preview view, và tests preview/download/authorization.
- Thêm admin gate `access-admin`, `AdminDashboardController`, admin dashboard view users/projects/filter status, và tests admin/non-admin/filter.
- Bật API routing Laravel 13, thêm API video project create/status/result, `VideoProjectResource`, API FormRequest, và tests create/status/result/unauthorized/forbidden.
- Thêm notifications table, `VideoProjectCompleted` event, listener gửi `VideoProjectRenderedNotification`, và test notification khi render completed.
- Thêm `PipelineException`, status failure helper, render provider failure mapping/logging, `RenderVideoJob::failed`, và tests failure path.
- Bổ sung `MockVideoPipelineFlowTest` kiểm tra happy path mock pipeline từ script đến render output.
- Security review: API/status không expose `rendered_video_path`, resource trả preview/download URL an toàn, thêm throttle `api` limiter, và tests bảo mật tương ứng.
- Thêm README root và cập nhật README app với setup, routes, mock providers, queue/render mock, security notes, và validation commands.
- Final review/polish: chạy lại autoload, migration, test suite, và xác nhận không còn task pending.

## 2026-05-26

- Khởi tạo bộ Autonomous Laravel Agents System cho repo hiện tại.
- Thêm rules cho Laravel code, database, API, testing, và workflow agent.
- Thêm context files, memory files, prompt files, và task templates.
- Bổ sung product context, route map sơ bộ, và schema sơ bộ cho MVP AI Video Generator.
