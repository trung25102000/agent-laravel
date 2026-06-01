# Task: Real 3 To 4 Minute Video Rendering

## Status
completed

## Priority
critical

## Objective
Nang pipeline tu mock output len kha nang tao duoc mot video MP4 that dai tu 3 den 4 phut, ty le doc 9:16, co hinh nen theo scene, voice over, subtitle, va file output co the preview/download.

## Requirements
- Tich hop render provider FFmpeg that thay cho mock provider khi cau hinh `VIDEO_RENDER_PROVIDER=ffmpeg`.
- Tao duoc video MP4 1080x1920, H.264/AAC, thoi luong muc tieu 180-240 giay.
- Pipeline phai tao du thoi luong voice/audio hoac lap/keo dai scene hop ly de dat 3-4 phut.
- Moi scene can co visual asset dau vao that: anh generated/downloaded/local placeholder hop le, khong phai file text gia.
- Voice over can la file audio hop le; neu chua co API TTS that, tao fallback audio hop le bang FFmpeg tone/silence hoac provider local de pipeline van render duoc video that.
- Subtitle phai duoc tao thanh file `.srt` hoac `.ass` hop le va burn-in vao video.
- Render phai chay qua queue job, co timeout/retry/error handling ro rang.
- Luu output path, duration, size, render metadata, va error message neu fail.
- Co cau hinh gioi han chi phi/thoi luong de user khong render qua dai ngoai MVP.
- Ghi log command FFmpeg da sanitize, exit code, stderr rut gon, va artifact path de debug.

## Files Expected
- `video-generator-app/config/video_pipeline.php`
- `video-generator-app/app/Services/Rendering/Contracts/RenderProviderInterface.php`
- `video-generator-app/app/Services/Rendering/FfmpegRenderProvider.php`
- `video-generator-app/app/Services/VideoRenderService.php`
- `video-generator-app/app/Jobs/RenderVideoJob.php`
- migration bo sung render metadata neu can
- service tao subtitle/audio/asset fallback neu can
- tests unit/feature cho FFmpeg provider va render job
- tai lieu env trong `video-generator-app/README.md`
- `.agents/memory/progress.md`
- `.agents/memory/changelog.md`
- `.agents/memory/bugs.md` neu gap loi FFmpeg moi truong
- `.agents/context/decisions.md`

## Implementation Notes
- Kiem tra `ffmpeg` va `ffprobe` co ton tai truoc khi render; fail som voi loi ro rang neu thieu.
- Dung `Symfony Process` hoac abstraction tuong duong de chay command an toan, khong noi chuoi shell voi input user raw.
- Input file nen nam trong storage rieng theo project, vi du `storage/app/private/video-projects/{id}`.
- Nen tao intermediate files ro rang: normalized images, narration audio, subtitles, concat list, final output.
- Can tranh shell injection, path traversal, va expose duong dan noi bo.
- Test FFmpeg co the duoc skip co dieu kien neu binary khong co trong CI/local, nhung can co unit test command builder/validation.
- Neu runtime local chua co image/TTS API, fallback van phai tao MP4 that bang asset/audio local hop le de chung minh pipeline end-to-end.

## Done When
- Co the tao mot project va queue job render ra file `.mp4` that dai trong khoang 180-240 giay.
- Output video la 1080x1920, playable, co audio track va subtitle burn-in.
- Preview/download route dung file output that va van duoc authorization bao ve.
- Khi FFmpeg fail, project chuyen sang failed va luu thong tin loi de user/admin debug.
- Test pass, bao gom test render provider voi fixture nho hoac test skip co dieu kien khi thieu FFmpeg.
- Tai lieu chay local/render that duoc cap nhat.

## Test Requirements
- Unit test command builder tao command an toan, dung resolution, codec, subtitle, va output path.
- Unit test provider bao loi ro khi thieu input hoac FFmpeg fail.
- Feature/job test render project cap nhat status/output path thanh cong voi provider fake hoac fixture nhanh.
- Neu co FFmpeg trong moi truong, integration test tao MP4 ngan tu fixture de xac thuc output playable bang `ffprobe`.
- Chay `php artisan test`.
