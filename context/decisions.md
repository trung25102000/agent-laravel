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

- Ngày: 2026-05-29
- Task: 064-problem-solution-storytelling-sections
- Loại: decision
- Nội dung: Bỏ carousel vấn đề dạng 4 story và chuyển sang 6 pain cards + solution mapping grid, vì mục tiêu của phase agency landing là scan nhanh và nhận diện nhu cầu rõ hơn thay vì đọc tuần tự từng slide.
- Lý do: Brief mới yêu cầu khách phải thấy ngay pain point của mình; grid tĩnh với hover nhẹ phục vụ conversion tốt hơn carousel dài trong phần này.
- Ảnh hưởng: Homepage section vấn đề/giải pháp trực diện hơn, mobile dễ quét hơn và task sau có thể tiếp tục nâng visual card/timeline mà không cần giữ logic carousel cũ.

- Ngày: 2026-05-29
- Task: 063-hero-section-agency-grade-redesign
- Loại: decision
- Nội dung: Dựng hero agency-grade hoàn toàn bằng Blade + HTML/CSS/JS nội bộ với 5 scene visual auto-cycle (website, dashboard, code, SEO, app), thay vì dùng ảnh raster hay thư viện animation ngoài.
- Lý do: Brief yêu cầu cảm giác chuyên nghiệp và motion rõ nhưng vẫn phải nhẹ, dễ maintain và không kéo thêm dependency nặng cho landing page.
- Ảnh hưởng: Homepage có hero conversion-first mạnh hơn, đồng thời tạo nền reusable cho các task visual tiếp theo như service cards, showcase và trust sections.

- Ngày: 2026-05-29
- Task: 062-final-service-platform-review-and-polish
- Loại: decision
- Nội dung: Đóng chuỗi service-platform `049-062` tại đây và giữ các task `063-071` là backlog presentation/CRO tách biệt, thay vì gộp toàn bộ UI agency-grade vào task final review của service domain.
- Lý do: `062` chỉ nên dùng để rà soát tính nhất quán, validation và tài liệu cho lớp domain/service đã hoàn tất; nếu nhét luôn redesign lớn sẽ làm mất vai trò review/finalize của task này.
- Ảnh hưởng: Service-platform core đã có thể xem như phase hoàn chỉnh; các task còn lại tập trung hoàn toàn vào hero, visual system, showcase và conversion polish sâu hơn.

- Ngày: 2026-05-29
- Task: 061-mobile-conversion-polish
- Loại: decision
- Nội dung: Tối ưu mobile theo hướng chống friction trực tiếp trong funnel hiện có: thêm khoảng đệm đáy cho sticky CTA, chuyển action groups sang stack dọc trên mobile, tăng kích thước nút và thêm marker test cho card/form/sticky bar.
- Lý do: Brief tập trung vào việc người dùng điện thoại phải hiểu dịch vụ và gửi yêu cầu nhanh; các thay đổi nhỏ nhưng đúng điểm ma sát sẽ hiệu quả hơn là redesign toàn bộ trong task này.
- Ảnh hưởng: Homepage, services và contact funnel bớt chật hơn trên mobile; các task visual lớn hơn sau này vẫn có thể reuse contract mobile markers hiện tại.

- Ngày: 2026-05-29
- Task: 060-technical-seo-and-performance-hardening
- Loại: decision
- Nội dung: Ưu tiên hardening ở lớp markup/layout thay vì thêm third-party tooling: canonical, robots, structured data mức an toàn, skip link, meta rõ cho các trang public chính và test smoke cho UI/performance markers.
- Lý do: Task yêu cầu technical SEO cơ bản tốt và tránh script nặng; các cải tiến này cho hiệu quả rõ mà không làm frontend phình thêm.
- Ảnh hưởng: Homepage, services và blog có head markup nhất quán hơn; các task CRO/UI sau vẫn có thể thay view mà giữ contract SEO đã test.

- Ngày: 2026-05-29
- Task: 059-blog-seo-content-pillars-and-internal-linking
- Loại: decision
- Nội dung: Mở rộng `blog_posts` với `content_pillar` và `service_group`, dùng blog index dạng pillar filter nhẹ và blog detail có related posts + soft links sang services/pricing/contact, thay vì dựng taxonomy CMS sâu hơn.
- Lý do: Cần tăng internal linking và giá trị SEO/chuyển đổi nhanh trong khi admin blog hiện tại vẫn đủ để nhập bài viết thủ công.
- Ảnh hưởng: Blog giờ đóng vai trò rõ hơn trong funnel lead generation; các task SEO/performance sau có thể tối ưu tiếp metadata và interlink mà không cần đổi domain model lớn.

- Ngày: 2026-05-29
- Task: 058-admin-lead-operations-and-notes
- Loại: decision
- Nội dung: Giữ admin lead operations ở mức lightweight bằng cách mở rộng các bảng lead hiện có với `lead_source`, `priority` và note nội bộ, thay vì tạo CRM entity mới; dashboard admin gom số liệu lead mới và listing cho phép cập nhật ngay tại chỗ.
- Lý do: Brief yêu cầu workflow tư vấn thực tế hơn nhưng không muốn admin phình thành hệ thống CRM lớn; tận dụng schema đang có sẽ nhanh validate và dễ maintain hơn.
- Ảnh hưởng: Orders, quotes, graduation requests và contact messages đều có filter/update thực dụng; customer record tiếp tục là nơi giữ note tái chăm sóc ngắn.

- Ngày: 2026-05-29
- Task: 057-contact-channel-and-sticky-cta-improvements
- Loại: decision
- Nội dung: Dùng contact strip ở đầu layout và sticky CTA chỉ cho mobile ở đáy màn hình, đồng thời tự ẩn sticky CTA khi block `#quote-form` đi vào viewport bằng `IntersectionObserver`.
- Lý do: Cần tăng hiện diện của Zalo/Facebook/Email và CTA chuyển đổi mà không spam nút nổi hoặc che nút submit của form báo giá hiện có.
- Ảnh hưởng: Public pages nhất quán hơn về contact copy; mobile có lối vào nhanh để chat hoặc nhảy tới form, còn desktop vẫn giữ layout sạch và tập trung vào CTA trong nội dung trang.

- Ngày: 2026-05-29
- Task: 049-seo-web-service-platform-positioning-audit
- Loại: decision
- Nội dung: Chốt định vị `seo-web-app` theo hướng service-first platform cho web, code, app, SEO và hỗ trợ kỹ thuật; các module template, source code và demo project được giữ lại như trust asset và offer phụ trợ thay vì thông điệp trung tâm của toàn site.
- Lý do: Audit public copy cho thấy homepage đã nghiêng về dịch vụ nhưng routes, README và context vẫn mô tả app như marketplace/template-first, dễ làm các task sau lệch thông điệp.
- Ảnh hưởng: Các task `050` trở đi sẽ ưu tiên service catalog, service detail pages, portfolio, funnel tư vấn và admin lead workflow trước khi polish phần template/source.

- Ngày: 2026-05-29
- Task: 050-service-catalog-domain-module
- Loại: decision
- Nội dung: Thiết kế `service_offerings` như một bảng độc lập với các trường JSON `target_audiences`, `key_benefits`, `process_steps` và status `draft/published`; public `/services` chỉ đọc bản ghi `published`, còn admin có thể tạo mới và bật/tắt publish ngay từ dashboard namespace marketplace hiện có.
- Lý do: Cần module dịch vụ đủ cấu trúc để tái sử dụng cho public pages tiếp theo nhưng chưa cần ràng buộc phức tạp tới pricing, blog hay lead tables ở phase đầu.
- Ảnh hưởng: Task `051` có thể thêm service detail pages trực tiếp từ dữ liệu thật; admin workflow tạm dùng route `/admin/marketplace/services` trước khi được đổi naming rộng hơn ở các task sau.

- Ngày: 2026-05-29
- Task: 051-service-detail-pages-and-routing
- Loại: decision
- Nội dung: Dùng blueprint nội dung theo `service_group` ngay trong `MarketplaceController` để dựng problem/scope/technology/timeline cho service detail pages, trong khi dữ liệu `service_offerings` vẫn giữ phần mô tả kinh doanh, lợi ích, audience và process ở mức có thể chỉnh bởi admin.
- Lý do: Mỗi nhóm dịch vụ cần copy chi tiết khác nhau ngay ở phase này, nhưng chưa cần mở rộng admin thành CMS giàu trường cấu trúc cho mọi block nội dung.
- Ảnh hưởng: Public route `/services/{slug}` đã hoạt động với content detail nhất quán; nếu sau này cần editable toàn bộ block detail từ admin thì có thể tách blueprint này thành schema hoặc content module riêng.

- Ngày: 2026-05-29
- Task: 052-homepage-service-repositioning
- Loại: decision
- Nội dung: Reposition homepage theo hướng service-first bằng cách dùng `service_offerings` làm section “Danh sách dịch vụ”, giữ template/demo như proof/portfolio phụ trợ, và dùng feedback copy tĩnh ngắn ở phase này thay vì chờ module testimonial hoàn chỉnh.
- Lý do: Task yêu cầu homepage phải chuyển trọng tâm ngay sang dịch vụ và tăng khả năng chuyển đổi; module feedback/portfolio đầy đủ sẽ được tách task sau để không chặn refactor trang chủ.
- Ảnh hưởng: Homepage hiện đọc vào là hiểu đây là website cung cấp dịch vụ công nghệ; các task `054` và `055` sau sẽ có thể thay section proof tạm thời bằng dữ liệu portfolio/testimonial có cấu trúc.

- Ngày: 2026-05-29
- Task: 053-quick-consultation-and-quote-funnel-optimization
- Loại: decision
- Nội dung: Giữ nhiều funnel public riêng (`quote`, `graduation`, `contact`, `order`) nhưng chuẩn hóa `quote` thành entry-point chính cho website/sửa web/SEO/task code, với thêm `preferred_contact_channel`, `budget_range`, `deadline` và `technology_stack`; `contact_messages` được phép lưu ngữ cảnh dịch vụ để tránh mất lead mơ hồ.
- Lý do: User phổ thông cần gửi nhu cầu nhanh ngay trên homepage, trong khi sinh viên và khách mua source vẫn có use case riêng chưa nên ép vào một form duy nhất.
- Ảnh hưởng: Quote funnel giàu thông tin hơn cho tư vấn/báo giá; task admin lead workflow sau có thêm dữ liệu để ưu tiên xử lý lead đúng kênh và đúng công nghệ.

- Ngày: 2026-05-29
- Task: backlog-landing-page-agency-ui
- Loại: decision
- Nội dung: Tạo thêm chuỗi task `063` đến `071` chuyên cho presentation/conversion của landing page, tách biệt với các task domain/service platform hiện có như portfolio, feedback, technical SEO và mobile polish.
- Lý do: Brief mới tập trung mạnh vào cảm giác agency, visual richness, motion và khả năng “muốn liên hệ ngay”; nếu gộp hết vào các task domain đang có sẽ làm task quá rộng và khó review.
- Ảnh hưởng: Agent có hai lớp backlog phối hợp với nhau: lớp domain/data (`054-062`) và lớp UI/CRO (`063-071`), giúp triển khai có thứ tự hơn và giảm rủi ro chồng chéo.

- Ngày: 2026-05-29
- Task: 054-portfolio-and-case-study-module
- Loại: decision
- Nội dung: Tận dụng bảng `demo_projects` hiện có làm nguồn dữ liệu portfolio/case study thay vì tạo module mới, nhưng mở rộng schema để đủ thông tin công khai như slug, project_type, bài toán, giải pháp, tech stack, vai trò và kết quả.
- Lý do: `demo_projects` đã là entity gần nhất với portfolio trong app hiện tại; mở rộng bảng hiện có giảm duplicate domain và cho phép homepage/source/template reuse cùng một data source.
- Ảnh hưởng: Public routes `/portfolio` và `/portfolio/{slug}` đã hoạt động; admin namespace `demo-projects` tiếp tục được dùng nội bộ nhưng public copy chuyển thành portfolio/case study.

- Ngày: 2026-05-29
- Task: 055-feedback-and-social-proof-module
- Loại: decision
- Nội dung: Dùng bảng `testimonials` riêng để quản lý feedback có cấu trúc, thay block feedback tĩnh trên homepage; service detail page lọc feedback theo `service_type` khớp với `service_group` để tạo social proof sát ngữ cảnh.
- Lý do: Feedback là trust signal quan trọng cho homepage và service pages, cần publish workflow độc lập thay vì hard-code trong view.
- Ảnh hưởng: Homepage và service detail đã hiển thị testimonial publish từ database; task UI/carousel sau có thể reuse cùng data source mà không cần đổi schema nữa.

- Ngày: 2026-05-29
- Task: 056-pricing-reference-and-support-plans
- Loại: decision
- Nội dung: Giữ route `/pricing/{type}` nhưng mở rộng type theo service platform (`shop`, `landing-page`, `ui-fix`, `seo`, `graduation-project`, `coding-task`) và chuyển filtering sang `package_type` thay vì chỉ bám `audience_type`.
- Lý do: Bảng giá mới cần phản ánh đúng offer thực tế theo loại dịch vụ, trong khi route cũ vẫn đủ dễ hiểu và không cần phá URL structure đã có.
- Ảnh hưởng: Pricing pages hiện mang tính tham khảo rõ hơn, CTA đẩy về quote funnel chính xác hơn và các package types mới có thể seed/mở rộng mà không phải đổi routing lần nữa.

- Ngày: 2026-05-29
- Task: backlog-seo-web-service-platform
- Loại: decision
- Nội dung: Chia yêu cầu mới của user cho `seo-web-app` thành chuỗi task nhỏ `049` đến `062`, ưu tiên xử lý theo thứ tự từ định vị nội dung và domain service trước, rồi mới đến public pages, funnel chuyển đổi, admin operations, SEO/performance và final review.
- Lý do: Hệ thống hiện đã có nền marketplace/source/template; nếu sửa trực tiếp không chia pha sẽ dễ chồng chéo domain, khó review và khó giữ tính nhất quán giữa content, schema, UI và admin workflow.
- Ảnh hưởng: Agent có backlog rõ ràng để tiếp tục tự động, mỗi task có phạm vi nhỏ hơn, dễ validate và giảm rủi ro regress trong `seo-web-app`.

- Ngày: 2026-05-28
- Task: 034-separate-source-audit-and-target-architecture
- Loại: decision
- Nội dung: Tách repo thành hai Laravel app độc lập `seo-web-app/` và `video-generator-app/`; copy auth/admin tối giản vào từng app thay vì tạo shared package.
- Lý do: Hai domain có lifecycle, deploy, route, database và branding khác nhau; shared package lúc này làm tăng độ phức tạp khi chưa có logic dùng chung đủ lớn.
- Ảnh hưởng: Mỗi app có composer/npm/env/migration/test riêng; root repo vẫn là control plane cho agent/tasks/context.

- Ngày: 2026-05-28
- Task: post-027-audio-narration-fix
- Loại: decision
- Nội dung: Demo audio local ưu tiên dùng macOS `say` để tạo narration `.aiff`; test/CI vẫn dùng generated WAV fallback để không phụ thuộc OS.
- Lý do: User cần nghe được tiếng/voice-over trong preview, không chỉ có audio stream hoặc tone kỹ thuật.
- Ảnh hưởng: Trên macOS local demo có narration; trên môi trường không có `say`, command vẫn tạo audio nghe được bằng WAV tone fallback cho đến khi có TTS provider thật.

- Ngày: 2026-05-28
- Task: 027-fix-audio-and-reference-based-xianxia-scenes
- Loại: decision
- Nội dung: Sửa demo audio bằng service sinh WAV nghe được trong PHP và bắt FFmpeg provider probe audio stream/volume sau render; reference YouTube chỉ lưu làm metadata, visual vẫn là asset gốc `reference_inspired_original`.
- Lý do: Cần đảm bảo output demo có audio thật ngay cả khi chưa có TTS provider/API key và tránh sao chép frame YouTube khi chưa xác nhận quyền sử dụng.
- Ảnh hưởng: Demo command có thể tái tạo video có audio; render metadata có thêm `has_audio`, `audio_codec`, `audio_duration_seconds`, `audio_max_volume`, `audio_mean_volume`.

- Ngày: 2026-05-28
- Task: 026-xianxia-scene-character-demo-video
- Loại: decision
- Nội dung: Tạo command local `demo:xianxia-review` và service dùng GD để sinh PNG nhân vật theo scene, sau đó render qua FFmpeg provider hiện có; thêm `--skip-render` để test không phụ thuộc FFmpeg.
- Lý do: User cần một video demo xem thật với nhân vật từng cảnh ngay trong UI, trong khi image AI provider thật chưa được tích hợp.
- Ảnh hưởng: Demo local có thể tái tạo bằng Artisan command; production vẫn nên thay phần GD demo bằng image/video AI provider thật khi có key/provider.

- Ngày: 2026-05-27
- Task: 025-clear-real-video-preview-player
- Loại: decision
- Nội dung: Thêm route owner-only `/video-projects/{videoProject}/stream` để phục vụ MP4 inline cho `<video src>`, giữ route download riêng cho attachment và thêm helper model kiểm tra playable output.
- Lý do: Download response không tối ưu cho preview browser và không nên expose storage path nội bộ trong view/API.
- Ảnh hưởng: Preview player dùng URL protected, non-owner bị 403, output missing/unplayable hiển thị safe state thay vì rò path hoặc cố render file giả.

- Ngày: 2026-05-27
- Task: 024-warm-branded-auth-and-landing-ui
- Loại: decision
- Nội dung: Giữ UI auth/landing bằng Blade + Tailwind và dùng palette teal/amber/sky tren nen near-white thay vì thêm starter kit hoặc SPA.
- Lý do: Task yêu cầu giao diện thân thiện và bỏ cảm giác mặc định Laravel; stack hiện có đủ để làm nhanh, dễ test, ít rủi ro.
- Ảnh hưởng: Các trang guest dùng cùng layout app, CTA hướng rõ vào login/register/workspace, và test kiểm tra không còn welcome copy mặc định.

- Ngày: 2026-05-27
- Task: 023-real-3-to-4-minute-video-rendering
- Loại: decision
- Nội dung: Thêm `FfmpegRenderProvider` bật qua `VIDEO_RENDER_PROVIDER=ffmpeg`, vẫn giữ `MockRenderProvider` làm mặc định để local/test không phụ thuộc FFmpeg nếu chưa cấu hình.
- Lý do: FFmpeg là dependency hệ thống nặng; provider abstraction cho phép MVP chạy ổn với mock và bật render thật khi môi trường có binary.
- Ảnh hưởng: Queue/render production cần cài `ffmpeg`/`ffprobe`; integration test render MP4 thật skip nếu thiếu binary.

- Ngày: 2026-05-27
- Task: 023-real-3-to-4-minute-video-rendering
- Loại: decision
- Nội dung: FFmpeg provider tự tạo fallback JPEG, silent AAC audio, và SRT render-specific khi mock AI media/TTS hiện tại chưa tạo binary thật.
- Lý do: Yêu cầu task cần tạo được MP4 thật end-to-end ngay cả khi chưa có API image/TTS thật.
- Ảnh hưởng: Output là video thật/playable; nội dung media fallback còn đơn giản cho đến khi tích hợp provider AI image/TTS thật.

- Ngày: 2026-05-27
- Task: 022-complete-user-friendly-ui
- Loại: decision
- Nội dung: Giữ MVP frontend trên Blade + Tailwind/Vite, bổ sung status label/badge trong enum và accessor hiển thị trong model thay vì thêm Vue/React hoặc package UI mới.
- Lý do: Task yêu cầu giao diện hoàn chỉnh, dễ dùng nhưng không cần SPA; Blade hiện có đủ để cải thiện workflow và giữ kiến trúc đơn giản.
- Ảnh hưởng: UI build cần Tailwind scan cả `app/**/*.php` để các class badge trong enum được đưa vào CSS production.

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
- Ngày: 2026-05-29
- Task: 065-service-cards-visual-upgrade
- Loại: decision
- Nội dung: Giữ domain `service_offerings` ở 5 nhóm dịch vụ lõi hiện tại, còn `Mobile App Development` và `Technical Consultation` được hiển thị như extended offers trong homepage/service catalog thay vì thêm seed/domain entity mới ngay.
- Lý do: Brief UI cần đủ 7 service cards để tăng cảm giác năng lực, nhưng data/service detail hiện vẫn xoay quanh 5 nhóm offer đã được seed và liên kết đầy đủ vào funnel hiện tại.
- Ảnh hưởng: Card UI đã thể hiện breadth dịch vụ ngay trên landing page, trong khi expansion dữ liệu/public detail cho 2 offer bổ sung có thể được triển khai ở phase domain sau nếu cần.
- Ngày: 2026-05-29
- Task: 066-portfolio-ui-showcase-upgrade
- Loại: decision
- Nội dung: Dùng `project_type` của `demo_projects` để gán visual identity cho portfolio card/showcase thay vì thêm asset model hoặc media pipeline mới ở giai đoạn này.
- Lý do: Dữ liệu portfolio hiện đã đủ cho bài toán trust và conversion nếu được trình bày lại bằng mockup, role, outcome và tech stack; mở rộng media domain lúc này sẽ vượt phạm vi task UI.
- Ảnh hưởng: Homepage teaser, `/portfolio` và `/portfolio/{slug}` có thể tạo cảm giác agency/case-study rõ hơn mà vẫn bám domain hiện có từ task `054`.
- Ngày: 2026-05-29
- Task: 067-process-feedback-and-tech-trust-sections
- Loại: decision
- Nội dung: Dùng text badges theo tech stack cho marquee công nghệ thay vì đưa logo raster/SVG mới vào repo ở giai đoạn này.
- Lý do: Task cần tăng trust kỹ thuật và motion consistency ngay trên homepage, trong khi asset/logo mới sẽ kéo thêm bài toán sourcing, bản quyền và pipeline hình ảnh ngoài phạm vi UI hiện tại.
- Ảnh hưởng: Section công nghệ vẫn truyền đạt được năng lực Laravel/PHP/React/Next.js/MySQL/Docker/AWS/Redis/Linux, đồng thời giữ repo gọn để phase `069` xử lý rotating media/showcase assets sâu hơn nếu cần.
- Ngày: 2026-05-29
- Task: 068-visual-system-colors-and-motion-foundation
- Loại: decision
- Nội dung: Thiết lập visual system mới theo hướng foundation-first: palette tokens, site shell gradient, particle background, motion utilities, skeleton/count-up hooks được đặt ở layout/assets trước khi mở rộng tiếp vào từng showcase section.
- Lý do: Các task `069-070` cần một lớp theme/motion dùng chung để tránh tiếp tục vá cục bộ từng section và làm landing page thiếu nhất quán.
- Ảnh hưởng: Public pages đã dùng chung visual shell mới; các section sau có thể tái sử dụng `data-count-up`, `skeleton-shimmer`, particles và token màu mà không phải đổi kiến trúc asset thêm lần nữa.
- Ngày: 2026-05-29
- Task: 069-rotating-media-and-showcase-assets
- Loại: decision
- Nội dung: Dùng hero media showcase dạng composited HTML/CSS với 6 trạng thái và thumbnail rail đồng bộ thay vì thêm ảnh thật nặng vào repo.
- Lý do: Brief cần cảm giác media thật hơn icon thuần nhưng task vẫn phải giữ load nhẹ, không mở thêm pipeline asset/preload phức tạp trong giai đoạn cuối của landing page.
- Ảnh hưởng: Homepage đã có rotating media cho website mockup, dashboard analytics, laptop coding, SEO chart, mobile preview và team/support mà vẫn bám reduced-motion support sẵn có.
- Ngày: 2026-05-29
- Task: 070-homepage-conversion-cro-polish
- Loại: decision
- Nội dung: Đưa proof strip và CTA/form chính lên sớm hơn trong homepage thay vì chỉ để funnel ở cuối trang.
- Lý do: Sau khi visual sections đã đủ mạnh, điểm nghẽn conversion còn lại là người dùng phải cuộn khá sâu mới gặp form và kỳ vọng phản hồi chưa đủ rõ.
- Ảnh hưởng: Homepage hiện nhấn mạnh response timing, service fit và kênh liên hệ sớm hơn; contact CTA cũng nói rõ hơn về scope, timeline và đầu ra người dùng sẽ nhận.
- Ngày: 2026-05-29
- Task: 072-floating-contact-icons-and-footer-emphasis
- Loại: decision
- Nội dung: Thay quick-contact text links bằng floating icon cluster toàn site và ẩn cluster này khi quote form đang nằm trong viewport.
- Lý do: User muốn contact actions nổi bật ở góc phải dưới nhưng không được che form/CTA chính; dùng cùng observer với sticky CTA giúp giảm chồng lớp UI mà không cần thêm logic phức tạp.
- Ảnh hưởng: Homepage không còn section công nghệ sử dụng; footer và quick-contact layer giờ là điểm kết thúc/chuyển đổi rõ hơn trên desktop lẫn mobile.
