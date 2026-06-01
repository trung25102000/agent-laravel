# Changelog

## 2026-06-01

- Bổ sung tài liệu `tasks/home-page-review.md`: audit đầy đủ Home Page hiện tại của `seo-web-app` theo góc nhìn khách hàng mới, bao phủ 5-second test, information architecture, conversion flow, đề xuất giữ/rút gọn/chuyển trang/xóa và wireframe Home Page tối ưu hơn.
- Bổ sung tài liệu `tasks/home-page-improvement-plan.md`: chuyển kết quả audit thành kế hoạch triển khai cụ thể theo component, section, thứ tự rollout và mức độ ảnh hưởng.
- Tạo backlog executable `tasks/073-homepage-ux-simplification-and-conversion-refactor.md` từ hai tài liệu audit/plan ở trên, để workflow agent có thể auto-pick task Home Page này theo chuẩn `## Status / pending`.
- Hoàn tất task `073-homepage-ux-simplification-and-conversion-refactor`: refactor Home Page của `seo-web-app` theo hướng ít section hơn, bỏ pricing/FAQ khỏi trang chủ, siết lại Hero thành message rõ dịch vụ/đối tượng/CTA, rút process xuống 4 bước, giữ portfolio/feedback như trust asset ngắn hơn và tối giản `contact-cta`.
- Cập nhật các feature tests public/home/contact/performance/social-proof để bám contract Home Page mới; `seo-web-app` pass `php artisan migrate`, `php artisan test` (51 tests / 381 assertions) và `npm run build`.
- Validation task 073 cần dùng `composer dump-autoload --ignore-platform-req=php` do shell hiện tại chạy PHP `8.3.6` trong khi app yêu cầu `>= 8.4.0`.
- Bổ sung backlog executable `tasks/074-ux-writing-review-and-content-optimization.md` để audit và tối ưu toàn bộ text hiển thị cho người dùng trên `seo-web-app`, bao gồm hero, CTA, form, empty state, messages và validation wording.
- Hoàn tất task `074-ux-writing-review-and-content-optimization`: tạo báo cáo `tasks/content-review-report.md`, đồng bộ lại UX writing public-facing theo hướng ít kỹ thuật hơn, rõ lợi ích hơn và dễ hành động hơn trên Home/Services/Portfolio/Blog/Pricing/Templates/Source Code/Auth.
- Đặt locale mặc định `seo-web-app` sang `vi`, bổ sung `lang/vi/auth.php` và `lang/vi/validation.php`, đồng thời cập nhật các feature tests theo wording mới; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (51 tests / 381 assertions) và `npm run build`.

## 2026-05-29

- Hoàn tất task `064-problem-solution-storytelling-sections`: thay problem carousel bằng 6 pain cards rõ ràng và solution mapping grid, đồng thời cập nhật các landing tests sang contract mới theo hướng scan nhanh và conversion-first.
- Cập nhật `LandingPageExperienceTest`, `ProblemStoryCarouselTest`, `BrandedEntryUiTest`, `PerformanceUiSmokeTest`; `seo-web-app` pass `php artisan test` (50 tests / 352 assertions) và `npm run build`.
- Hoàn tất task `063-hero-section-agency-grade-redesign`: thay hero homepage bằng bố cục 2 cột kiểu agency, headline/CTA mới, service bullets rõ ràng và visual auto-cycle 5 trạng thái cho website/dashboard/code/SEO/app.
- Cập nhật `HomepageServicePositioningTest`, `BrandedEntryUiTest`, `AnimatedTrustVisualsTest`, `MarketplacePublicTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (50 tests / 354 assertions) và `npm run build`.
- Hoàn tất task `062-final-service-platform-review-and-polish`: rà soát lại .agents/context/README/routes/schema của `seo-web-app`, chạy lại `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test`, `npm run build`, `vendor/bin/pint` và chốt phase service-platform `049-062`.
- Hoàn tất task `061-mobile-conversion-polish`: thêm khoảng đệm đáy để sticky CTA không che nội dung, stack CTA hợp lý hơn trên mobile, tối ưu contact funnel/card actions cho thao tác chạm và khóa lại bằng mobile UI markers.
- Thêm `MobileConversionUiTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (50 tests / 349 assertions) và `npm run build`.
- Hoàn tất task `060-technical-seo-and-performance-hardening`: thêm `robots`, `canonical`, structured data cơ bản cho homepage/services/blog article, skip link semantic và smoke coverage cho các marker UI/SEO chính; `npm run build` tiếp tục pass.
- Thêm `TechnicalSeoTest` và `PerformanceUiSmokeTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (49 tests / 337 assertions) và `npm run build`.
- Hoàn tất task `059-blog-seo-content-pillars-and-internal-linking`: thêm `content_pillar` + `service_group` cho blog posts, blog index theo trụ cột nội dung, blog detail có related posts, soft links sang services/pricing và contact CTA gắn theo dịch vụ liên quan.
- Thêm `BlogContentPillarsTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (46 tests / 308 assertions).
- Hoàn tất task `058-admin-lead-operations-and-notes`: mở rộng metadata lead cho orders/quotes/graduation/contacts, thêm dashboard lead overview, filters thực dụng và form cập nhật note/trạng thái/ưu tiên ngay trong admin.
- Thêm `AdminLeadOperationsTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (44 tests / 299 assertions).
- Hoàn tất task `057-contact-channel-and-sticky-cta-improvements`: thêm contact strip toàn site, mobile sticky CTA cho tư vấn nhanh/Zalo/xem dịch vụ, chuẩn hóa copy phản hồi nhanh và hướng dẫn gửi nhu cầu trong block contact CTA.
- Thêm `ContactChannelCtaTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (42 tests / 285 assertions) và `npm run build`.
- Hoàn tất task `056-pricing-reference-and-support-plans`: mở rộng route pricing cho `ui-fix`, `seo`, `coding-task`, cập nhật seed package types mới và chỉnh pricing page theo hướng giá tham khảo + CTA nhận báo giá chính xác.
- Thêm `PricingReferenceTest`; `seo-web-app` pass `php artisan test` (40 tests / 271 assertions) và `composer dump-autoload --ignore-platform-req=php`.
- Hoàn tất task `055-feedback-and-social-proof-module`: thêm model/migration `testimonials`, admin page feedback, seed social proof có cấu trúc và render feedback publish ở homepage + service detail pages.
- Thêm `FeedbackSocialProofTest`; `seo-web-app` pass `php artisan migrate`, `php artisan test` (39 tests / 265 assertions) và `composer dump-autoload --ignore-platform-req=php`.
- Hoàn tất task `054-portfolio-and-case-study-module`: mở rộng `demo_projects` cho portfolio/case study, thêm public pages `/portfolio` và `/portfolio/{slug}`, seed case studies thực tế hơn, nối link từ homepage/services và thêm admin management tối thiểu.
- Thêm `PortfolioCaseStudyTest`; `seo-web-app` pass `php artisan migrate`, `php artisan test` (37 tests / 254 assertions) và `composer dump-autoload --ignore-platform-req=php`.
- Bổ sung backlog UI/CRO mới `063` đến `071` cho `seo-web-app`, tập trung vào hero section kiểu agency, problem-solution storytelling, service cards có visual identity mạnh hơn, portfolio showcase, feedback/process/tech trust sections, visual system mới, rotating media showcase, CRO polish và final landing page review.
- Hoàn tất task `053-quick-consultation-and-quote-funnel-optimization`: mở rộng schema `quote_requests` và `contact_messages`, chuẩn hóa `contact-cta` thành funnel tư vấn/báo giá rõ ràng hơn và thêm test validation/success cho consultation flow.
- `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (34 tests / 241 assertions) sau khi mở rộng funnel lead.
- Hoàn tất task `052-homepage-service-repositioning`: homepage chuyển sang service-first với hero mới, section danh sách dịch vụ từ dữ liệu thật, portfolio/demo như trust asset phụ trợ và feedback block phục vụ chuyển đổi.
- Thêm `HomepageServicePositioningTest`, cập nhật branded/public homepage assertions; `seo-web-app` pass `php artisan test` (32 tests / 233 assertions), `npm run build`, `composer dump-autoload --ignore-platform-req=php` và `php artisan migrate`.
- Hoàn tất task `051-service-detail-pages-and-routing`: thêm route public `/services/{serviceOffering:slug}`, trang detail dịch vụ với blueprint nội dung theo `service_group`, internal linking sang pricing/blog và CTA quote form theo từng dịch vụ.
- Thêm `ServiceDetailPagesTest`; full suite `seo-web-app` pass 31 tests / 225 assertions.
- Hoàn tất task `050-service-catalog-domain-module`: thêm model `ServiceOffering`, migration `service_offerings`, seeder 5 dịch vụ trọng tâm, admin route/view quản lý trạng thái publish và cập nhật `/services` để render từ dữ liệu thật.
- Thêm `ServiceCatalogTest`, cập nhật `MarketplacePublicTest`; validation `seo-web-app` pass với `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (29 tests / 215 assertions).
- Hoàn tất task `049-seo-web-service-platform-positioning-audit`: audit public positioning của `seo-web-app`, chốt hướng service-first platform cho web, code, app, SEO và hỗ trợ kỹ thuật; cập nhật project context, routes map, README và decision log để template/source/demo được định nghĩa là trust asset và offer phụ trợ.
- Bổ sung backlog mới `049` đến `062` cho `seo-web-app`, chia nhỏ roadmap chuyển đổi hệ thống sang nền tảng dịch vụ web, code, app, SEO và hỗ trợ kỹ thuật: định vị nội dung, catalog dịch vụ, service detail pages, portfolio, feedback, pricing, contact CTA, admin lead workflow, blog SEO, technical SEO/performance, mobile polish và final review.
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
- Thêm MarketplaceSeeder, AdminUserSeeder, feature tests public/form/admin/SEO, cập nhật docs .agents/context/routes/schema/.agents/memory.
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
- Cập nhật bộ agent/.agents/rules/.agents/context để mặc định làm việc với Laravel 13.x và PHP 8.5.
- Thêm `.agents/rules/platform-version-rules.md` làm luật nền cho Composer constraint, skeleton Laravel 13, Vite, API routing, và style PHP 8.5.
- Cập nhật prompt start/continue/review và các task foundation, auth, API để tránh giả định Laravel 11/12 hoặc cấu trúc legacy.
- Bắt buộc bootstrap source Laravel trong `video-generator-app/`, giữ root repo cho bộ agent/.agents/rules/tasks/.agents/context.
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
- Hoàn tất task `065-service-cards-visual-upgrade`: nâng section dịch vụ trên homepage và `/services` thành card system có gradient/icon/mockup/benefit chips/CTA rõ ràng, đồng thời thêm extended offers cho mobile app và technical consultation để tăng độ phủ năng lực ngay trên landing page.
- Cập nhật `HomepageServicePositioningTest` và `ServiceCatalogTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (50 tests / 358 assertions) và `npm run build`.
- Hoàn tất task `066-portfolio-ui-showcase-upgrade`: nâng homepage portfolio teaser thành showcase lớn có hero case study, trust assets và supporting cards; đồng thời làm mới `/portfolio` và `/portfolio/{slug}` với mockup board, role, outcome, tech stack và CTA rõ hơn.
- Cập nhật `PortfolioCaseStudyTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (50 tests / 363 assertions) và `npm run build`.
- Hoàn tất task `067-process-feedback-and-tech-trust-sections`: homepage có process timeline 6 bước, feedback carousel auto-rotate 5 giây với reduced-motion fallback và tech marquee để tăng trust kỹ thuật ngay trên first-scroll sections.
- Cập nhật `FeedbackSocialProofTest` và `HomepageServicePositioningTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (50 tests / 368 assertions) và `npm run build`.
- Hoàn tất task `068-visual-system-colors-and-motion-foundation`: thêm design tokens cho palette mới, site shell gradient + particle background, motion utilities, skeleton/count-up hooks và marker visual system ở layout public.
- Cập nhật `AnimatedTrustVisualsTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (50 tests / 374 assertions) và `npm run build`.
- Hoàn tất task `069-rotating-media-and-showcase-assets`: hero homepage được nâng thành rotating media showcase 6 trạng thái với thumbnail rail, bổ sung thêm scene team/support để media coverage sát brief hơn mà không phải thêm asset nặng.
- Cập nhật `HomepageServicePositioningTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (50 tests / 377 assertions) và `npm run build`.
- Hoàn tất task `070-homepage-conversion-cro-polish`: thêm conversion proof strip ở hero, conversion strip giữa homepage, đưa contact CTA chính lên trước pricing và siết lại copy/funnel trong component `contact-cta`.
- Cập nhật `HomepageServicePositioningTest` và `ConsultationFunnelTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (51 tests / 384 assertions) và `npm run build`.
- Hoàn tất task `071-final-landing-page-agency-review`: chốt vòng review cuối cho chuỗi UI/conversion `063-071`, rà theo security/testing/refactor/documentation/devops, cập nhật lại project .agents/context/README và xác nhận không còn backlog pending trong nhánh landing page agency-grade.
- Final validation cho phase landing page: `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate --force`, `php artisan test` (51 tests / 384 assertions), `npm run build`, và `vendor/bin/pint` đều pass trong `seo-web-app`.
- Bổ sung backlog mới `072-floating-contact-icons-and-footer-emphasis` cho `seo-web-app`: bỏ section công nghệ sử dụng trên homepage, chuyển contact links sang floating contact icons góc phải dưới và nâng footer thành điểm nhấn rõ hơn ở cuối trang.
- Hoàn tất task `072-floating-contact-icons-and-footer-emphasis`: bỏ section “Công nghệ sử dụng”, thay quick-contact text links bằng floating icon cluster góc phải dưới và làm mới footer theo hướng service-first, CTA/trust rõ hơn.
- Cập nhật `HomepageServicePositioningTest`, `ContactChannelCtaTest`, `FeedbackSocialProofTest`; `seo-web-app` pass `composer dump-autoload --ignore-platform-req=php`, `php artisan migrate`, `php artisan test` (51 tests / 393 assertions) và `npm run build`.
