# Changelog

## 2026-05-27

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
