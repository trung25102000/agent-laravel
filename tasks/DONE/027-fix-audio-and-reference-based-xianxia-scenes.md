# Task: Fix Audio And Reference-Based Xianxia Scenes

## Status
completed

## Priority
high

## Objective
Fix bug output video review truyen tien hiep dang bi loi audio va nang cap hinh anh tung phan canh bang nhan vat ro rang theo reference. Output cuoi cung bat buoc phai la MP4 9:16 xem duoc tren UI va co audio nghe duoc, khong chi la silent track.

## User Context
- User dang xem project `#6` tai `GET /video-projects/6`.
- Video hien tai da co scene/character image nhung audio dang loi hoac khong nghe duoc.
- User cung cap reference YouTube:
  - `https://www.youtube.com/watch?v=5W-8VZa1jpw`
- Luu y: Link YouTube chi duoc dung lam reference khi co quyen phu hop. Khong mac dinh download/copy frame co ban quyen vao san pham. Neu chua co quyen, hay tao asset nhan vat goc theo mo ta visual/stylistic tu reference thay vi sao chep truc tiep.

## Scope
Task nay tap trung vao:
1. Bao dam output MP4 co audio thuc su nghe duoc.
2. Tao lai demo video review truyen tien hiep project `#6` voi visual nhan vat ro tung canh.
3. Them validation/test de tranh regression video co silent/missing audio.
4. Cap nhat command demo hien co de tao duoc video co voice/audio track hop le.

Khong bat buoc tich hop TTS provider that trong task nay neu chua co API key. Co the dung audio sinh bang FFmpeg local hoac provider noi bo deterministic, mien la output co audio nghe duoc va test/ffprobe xac nhan co audio stream.

## Requirements

### 1. Audio must be real and audible
- Output MP4 bat buoc co audio stream.
- Audio stream khong duoc chi la silent track `anullsrc`.
- Audio phai co duration khop gan voi video duration.
- Audio phai co codec browser-friendly, uu tien AAC.
- FFmpeg render provider phai uu tien audio asset hop le neu project co `audio_path`.
- Neu chua co TTS/audio provider that, command demo phai tao fallback audio nghe duoc bang FFmpeg:
  - co the dung generated tone/ambient narration surrogate
  - co the mix nhieu tone ngan theo tung scene
  - co the tao audio cue/voice-like placeholder deterministic
  - khong duoc tao track im lang roi coi la pass
- Metadata output phai ghi nhan:
  - `has_audio`: true
  - `audio_codec`
  - `audio_duration_seconds`
  - `audio_peak_or_volume_detected` neu implement duoc qua `volumedetect`
- Preview page hoac artifacts panel nen hien thi audio ready neu co audio asset.

### 2. Fix demo command
- Cap nhat `php artisan demo:xianxia-review` de:
  - tao/cap nhat project `#6` neu truyen `--project-id=6`
  - tao scene images moi theo nhan vat/phong cach reference
  - tao audio file hop le cho project
  - set `audio_disk`, `audio_path`, `audio_duration_seconds`
  - render MP4 bang FFmpeg provider
- Them option neu can:
  - `--reference-url=https://www.youtube.com/watch?v=5W-8VZa1jpw`
  - `--audio-mode=generated`
  - `--replace-project-output`
- Command phai in ra:
  - project id
  - preview URL
  - output path relative
  - audio path relative
  - ffprobe audio stream summary

### 3. Reference-based visual scenes
- Reference URL can duoc luu vao metadata project hoac asset metadata, vi du:
  - `render_metadata.reference_url`
  - `asset.metadata.reference_url`
- Neu co quyen su dung frame/asset tu YouTube:
  - chi luu file vao storage local/S3 qua pipeline
  - khong luu absolute path
  - ghi `source=licensed_reference`
- Neu khong co quyen:
  - tao asset goc bang generator noi bo hoac image AI prompt
  - ghi `source=reference_inspired_original`
- Moi scene can co visual nhan vat rieng, toi thieu:
  - ten nhan vat
  - vai tro trong review
  - palette/mood
  - prompt image
  - file image playable by FFmpeg
- Video khong duoc chi lap mot hinh cho toan bo 3 phut.
- Output nen co 6-8 scene, moi scene 20-35 giay.

### 4. FFmpeg/audio validation
- Them helper/service hoac method de probe output bang `ffprobe`.
- Sau render, xac nhan:
  - video stream ton tai
  - audio stream ton tai
  - audio codec la `aac` hoac codec browser ho tro
  - duration >= 170s voi video 3 phut
  - output size > 0
  - `rendered_video_path` ton tai tren disk
- Neu audio missing/silent:
  - command phai fail ro rang
  - project status chuyen `failed` hoac khong overwrite completed output cu
  - log an toan, khong lo absolute path trong UI/API

### 5. UI preview
- Preview page project `#6` phai load video moi.
- Browser media element phai co:
  - `duration` hop le
  - `videoWidth=1080`
  - `videoHeight=1920`
  - audio stream co the play
- Neu co the, artifacts panel hien:
  - Audio: Ready
  - Output: Ready
  - Duration
  - Resolution
  - Size
- Khong expose path noi bo.

## Suggested Implementation Plan
1. Doc lai:
   - `XianxiaReviewDemoService`
   - `GenerateXianxiaReviewDemoCommand`
   - `FfmpegRenderProvider`
   - `VideoRenderService`
   - `VideoProjectPreviewController`
   - preview Blade
   - tests lien quan preview/render/demo command
2. Tao hoac cap nhat service audio:
   - vi du `DemoAudioTrackService`
   - tao AAC/M4A audio co tone/ambient cues, duration khop target
   - luu file relative trong storage
3. Cap nhat `XianxiaReviewDemoService`:
   - tao audio asset type `voice`
   - gan `audio_disk`, `audio_path`, `audio_duration_seconds`
   - ghi metadata reference URL va audio generated mode
4. Cap nhat visual scene generation:
   - nhan `reference_url`
   - moi scene co character config rieng
   - source metadata ro rang `reference_inspired_original`
5. Cap nhat render/provider validation:
   - probe audio stream sau render
   - metadata `has_audio`
   - command fail neu output khong co audio
6. Render lai project:
   - `php artisan demo:xianxia-review --project-id=6 --reference-url=https://www.youtube.com/watch?v=5W-8VZa1jpw`
7. Mo preview va verify bang browser:
   - `/video-projects/6/preview`
   - check media metadata
   - neu co the check audio stream/volume bang ffprobe
8. Cap nhat docs/memory/bugs/decisions.

## Files Expected
- `video-generator-app/app/Console/Commands/GenerateXianxiaReviewDemoCommand.php`
- `video-generator-app/app/Services/XianxiaReviewDemoService.php`
- `video-generator-app/app/Services/Rendering/FfmpegRenderProvider.php`
- `video-generator-app/app/Services/VideoRenderService.php`
- `video-generator-app/app/Services/*Audio*Service.php` neu can tach service
- `video-generator-app/resources/views/video-projects/preview.blade.php` neu can hien audio ready
- `video-generator-app/tests/Feature/XianxiaReviewDemoCommandTest.php`
- `video-generator-app/tests/Unit/FfmpegRenderProviderTest.php`
- `video-generator-app/tests/Feature/VideoProjectPreviewDownloadTest.php` neu preview artifact doi
- `video-generator-app/README.md`
- `memory/progress.md`
- `memory/changelog.md`
- `memory/bugs.md`
- `context/decisions.md`

## Test Requirements
- Feature test command `demo:xianxia-review --skip-render` tao:
  - project demo
  - 6+ scenes
  - 6+ image assets
  - audio asset/path
  - `audio_duration_seconds`
  - reference metadata
- Unit/feature test audio generation:
  - file audio ton tai
  - extension/metadata dung
  - duration gan target neu co probe fake/real
- FFmpeg provider test:
  - khi project co audio asset hop le thi render command dung audio do, khong dung `anullsrc`
  - metadata output co `has_audio=true` khi probe thanh cong
- Command render integration test:
  - skip neu thieu FFmpeg/FFprobe
  - render output MP4 co audio stream theo ffprobe
- Preview test:
  - completed project co audio_path hien Audio Ready
  - stream route van owner-only
- Chay:
  - `composer dump-autoload`
  - `php artisan migrate`
  - `php artisan test`
  - `npm run build` neu Blade/CSS thay doi

## Acceptance Criteria
- Project `#6` duoc render lai thanh video review truyen tien hiep moi.
- Output MP4 co ca video stream va audio stream.
- Audio nghe duoc, khong phai silent track.
- Moi scene co visual nhan vat rieng, khong lap mot background tinh duy nhat.
- Preview UI play duoc output moi tai `/video-projects/6/preview`.
- Download route tai duoc file MP4 moi.
- FFprobe xac nhan:
  - video: `1080x1920`
  - audio stream: exists
  - audio codec: AAC hoac compatible
  - duration khoang 180s
- Tests pass.
- Task duoc dong theo workflow AGENTS, cap nhat memory/changelog/bugs/decisions.

## Risks And Notes
- YouTube reference co the co ban quyen. Khong copy frame/asset truc tiep neu user chua xac nhan quyen su dung.
- Local may thieu FFmpeg trong PATH; co the dung binary tam trong `node_modules` neu ton tai, nhung README van phai ghi production can FFmpeg he thong.
- Generated audio placeholder khong thay the TTS that cho production, nhung phai du nghe duoc va khong im lang de fix bug demo.
