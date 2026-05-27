<?php

namespace App\Services;

use App\Enums\VideoAssetTypeEnum;
use App\Enums\VideoProjectStatusEnum;
use App\Enums\VideoSceneStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use App\Models\VideoScene;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class XianxiaReviewDemoService
{
    public function __construct(
        private readonly DemoAudioTrackService $audioTrackService,
    ) {
    }

    /**
     * @return array{user: User, project: VideoProject}
     */
    public function createOrUpdate(
        string $email,
        string $password,
        ?int $projectId = null,
        string $referenceUrl = 'https://www.youtube.com/watch?v=5W-8VZa1jpw',
    ): array {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Demo Creator',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ],
        );

        $project = $projectId
            ? VideoProject::query()->whereKey($projectId)->where('user_id', $user->id)->first()
            : null;

        if (! $project) {
            $project = VideoProject::query()->firstOrNew([
                'user_id' => $user->id,
                'keyword' => 'Review truyện tiên hiệp: Kiếm Đạo Trường Sinh',
            ]);
        }

        $project->forceFill([
            'user_id' => $user->id,
            'keyword' => 'Review truyện tiên hiệp: Kiếm Đạo Trường Sinh',
            'content_brief' => 'Video review truyện tiên hiệp có nhân vật minh họa riêng cho từng cảnh.',
            'tone' => 'dramatic',
            'duration_seconds' => 180,
            'platform' => 'tiktok',
            'language' => 'vi',
            'status' => VideoProjectStatusEnum::Queued,
            'progress_percent' => 85,
            'error_message' => null,
            'script_content' => $this->scriptContent(),
            'audio_disk' => null,
            'audio_path' => null,
            'audio_duration_seconds' => null,
            'rendered_video_path' => null,
            'output_disk' => null,
            'render_duration_seconds' => null,
            'render_size_bytes' => null,
            'render_metadata' => [
                'reference_url' => $referenceUrl,
                'visual_source' => 'reference_inspired_original',
            ],
        ])->save();

        $this->replaceScenesAndAssets($project, $referenceUrl);
        $this->attachAudibleAudio($project, $referenceUrl);

        return [
            'user' => $user,
            'project' => $project->refresh()->load(['scenes.assets', 'assets']),
        ];
    }

    private function replaceScenesAndAssets(VideoProject $project, string $referenceUrl): void
    {
        $project->assets()->delete();
        $project->scenes()->delete();

        $disk = (string) config('video_pipeline.storage.output_disk');

        foreach ($this->sceneBlueprints() as $index => $sceneData) {
            $scene = VideoScene::create([
                'video_project_id' => $project->id,
                'sort_order' => $index + 1,
                'text' => $sceneData['text'],
                'duration_seconds' => 30,
                'visual_prompt' => $sceneData['visual_prompt'],
                'status' => VideoSceneStatusEnum::Ready,
            ]);

            $assetPath = sprintf('videos/video-projects/%d/xianxia-review/scene-%02d.png', $project->id, $index + 1);
            $absolutePath = Storage::disk($disk)->path($assetPath);
            $directory = dirname($absolutePath);

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $this->writeSceneImage($absolutePath, $sceneData, $index);

            $project->assets()->create([
                'video_scene_id' => $scene->id,
                'type' => VideoAssetTypeEnum::Image,
                'disk' => $disk,
                'path' => $assetPath,
                'source' => 'reference_inspired_original',
                'metadata' => [
                    'mime_type' => 'image/png',
                    'character' => $sceneData['character'],
                    'scene_title' => $sceneData['title'],
                    'role' => $sceneData['role'],
                    'reference_url' => $referenceUrl,
                    'visual_prompt' => $sceneData['visual_prompt'],
                ],
            ]);
        }
    }

    /**
     * @return array<int, array{title: string, character: string, role: string, text: string, visual_prompt: string, palette: array<int, array{0: int, 1: int, 2: int}>}>
     */
    private function sceneBlueprints(): array
    {
        return [
            [
                'title' => 'Mở đầu',
                'character' => 'Lục Thanh Phong',
                'role' => 'Nam chính kiếm tu',
                'text' => 'Review nhanh Kiếm Đạo Trường Sinh: một thiếu niên bị xem là phế mạch bước vào tiên môn, nhưng lại giữ trong tay bí mật của thanh kiếm cổ.',
                'visual_prompt' => 'young xianxia swordsman at mountain sect gate, ancient sword, cinematic vertical frame',
                'palette' => [[13, 27, 42], [32, 80, 114], [224, 174, 87]],
            ],
            [
                'title' => 'Biến cố',
                'character' => 'Bạch Linh Nhi',
                'role' => 'Nữ chính linh mạch',
                'text' => 'Điểm cuốn nhất là biến cố diệt môn. Nữ chính Bạch Linh Nhi không chỉ là người được cứu, mà còn là chìa khóa mở ra linh mạch bị phong ấn.',
                'visual_prompt' => 'xianxia heroine with white robe and glowing talisman, ruined sect, spiritual energy',
                'palette' => [[34, 13, 58], [91, 33, 182], [236, 213, 255]],
            ],
            [
                'title' => 'Tu luyện',
                'character' => 'Kiếm Linh Cổ',
                'role' => 'Sư phụ kiếm linh',
                'text' => 'Nhịp truyện tăng mạnh khi nhân vật chính gặp Kiếm Linh Cổ. Các cảnh tu luyện có logic cấp bậc rõ, không buff vô lý quá sớm.',
                'visual_prompt' => 'ancient sword spirit mentor, glowing sword cave, golden cultivation aura',
                'palette' => [[55, 48, 18], [161, 98, 7], [254, 243, 199]],
            ],
            [
                'title' => 'Đấu pháp',
                'character' => 'Ma Tôn Huyền Dạ',
                'role' => 'Phản diện ma tu',
                'text' => 'Phản diện Huyền Dạ rất đáng nhớ: tàn nhẫn, thông minh, và luôn ép nam chính phải trả giá sau mỗi lần thắng.',
                'visual_prompt' => 'dark xianxia demon lord, red moon, black armor, duel arena',
                'palette' => [[69, 10, 10], [153, 27, 27], [254, 202, 202]],
            ],
            [
                'title' => 'Cao trào',
                'character' => 'Lục Thanh Phong',
                'role' => 'Kiếm tu phá thiên kiếp',
                'text' => 'Cao trào ba mươi chương cuối là màn phá thiên kiếp. Truyện giữ được cảm xúc, có hy sinh, có lựa chọn, và có cái giá cho trường sinh.',
                'visual_prompt' => 'swordsman facing heavenly lightning tribulation, flying swords, epic clouds',
                'palette' => [[12, 74, 110], [14, 165, 233], [186, 230, 253]],
            ],
            [
                'title' => 'Kết luận',
                'character' => 'Song Kiếm Đồng Hành',
                'role' => 'Cặp nhân vật đồng hành',
                'text' => 'Nếu bạn thích tiên hiệp có kiếm tu, tình tiết trả thù, nhân vật trưởng thành rõ rệt, đây là bộ đáng đọc. Chấm nhanh: tám phẩy năm trên mười.',
                'visual_prompt' => 'xianxia couple standing on flying sword above clouds, sunrise, final recommendation',
                'palette' => [[20, 83, 45], [16, 185, 129], [209, 250, 229]],
            ],
        ];
    }

    private function attachAudibleAudio(VideoProject $project, string $referenceUrl): void
    {
        $audio = $this->audioTrackService->createAudibleWav(
            projectId: $project->id,
            durationSeconds: (int) $project->duration_seconds,
            narrationText: $project->script_content,
        );

        $project->forceFill([
            'audio_disk' => $audio['disk'],
            'audio_path' => $audio['path'],
            'audio_duration_seconds' => $audio['duration_seconds'],
        ])->save();

        $project->assets()->create([
            'video_scene_id' => null,
            'type' => VideoAssetTypeEnum::Voice,
            'disk' => $audio['disk'],
            'path' => $audio['path'],
            'source' => 'generated_audible_demo',
            'metadata' => [
                'mime_type' => $audio['mime_type'],
                'duration_seconds' => $audio['duration_seconds'],
                'sample_rate' => $audio['sample_rate'],
                'channels' => $audio['channels'],
                'generation_mode' => $audio['mode'],
                'reference_url' => $referenceUrl,
                'audio_mode' => $audio['mode'],
                'silent' => false,
            ],
        ]);
    }

    private function scriptContent(): string
    {
        return collect($this->sceneBlueprints())
            ->pluck('text')
            ->implode("\n\n");
    }

    /**
     * @param array{title: string, character: string, role: string, text: string, visual_prompt: string, palette: array<int, array{0: int, 1: int, 2: int}>} $sceneData
     */
    private function writeSceneImage(string $path, array $sceneData, int $index): void
    {
        $width = 1080;
        $height = 1920;
        $image = imagecreatetruecolor($width, $height);
        imageantialias($image, true);

        $this->fillGradient($image, $sceneData['palette'][0], $sceneData['palette'][1], $width, $height);
        $this->drawMoonAndMountains($image, $sceneData['palette'][2], $width, $height, $index);
        $this->drawCharacter($image, $sceneData['palette'][2], $width, $height, $index);
        $this->drawFrameText($image, $sceneData, $index);

        imagepng($image, $path);
        imagedestroy($image);
    }

    /**
     * @param array{0: int, 1: int, 2: int} $from
     * @param array{0: int, 1: int, 2: int} $to
     */
    private function fillGradient($image, array $from, array $to, int $width, int $height): void
    {
        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $color = imagecolorallocate(
                $image,
                (int) round($from[0] + (($to[0] - $from[0]) * $ratio)),
                (int) round($from[1] + (($to[1] - $from[1]) * $ratio)),
                (int) round($from[2] + (($to[2] - $from[2]) * $ratio)),
            );
            imageline($image, 0, $y, $width, $y, $color);
        }
    }

    /**
     * @param array{0: int, 1: int, 2: int} $accent
     */
    private function drawMoonAndMountains($image, array $accent, int $width, int $height, int $index): void
    {
        $moon = imagecolorallocatealpha($image, min($accent[0] + 30, 255), min($accent[1] + 30, 255), min($accent[2] + 30, 255), 20);
        $mist = imagecolorallocatealpha($image, 255, 255, 255, 95);
        $mountain = imagecolorallocatealpha($image, 5, 10, 18, 35);
        $ridge = imagecolorallocatealpha($image, 255, 255, 255, 100);

        imagefilledellipse($image, 820 - ($index % 2) * 520, 260 + ($index % 3) * 45, 170, 170, $moon);

        for ($i = 0; $i < 7; $i++) {
            imagearc($image, 160 * $i, 710 + ($i % 2) * 46, 420, 110, 185, 350, $mist);
        }

        imagefilledpolygon($image, [0, 880, 250, 520, 540, 900], 3, $mountain);
        imagefilledpolygon($image, [360, 900, 680, 430, 1080, 930], 3, $mountain);
        imagefilledpolygon($image, [0, 1030, 520, 620, 1080, 1060], 3, imagecolorallocatealpha($image, 0, 0, 0, 65));

        imageline($image, 250, 520, 540, 900, $ridge);
        imageline($image, 680, 430, 1080, 930, $ridge);
    }

    /**
     * @param array{0: int, 1: int, 2: int} $accent
     */
    private function drawCharacter($image, array $accent, int $width, int $height, int $index): void
    {
        $skin = imagecolorallocate($image, 241, 214, 190);
        $hair = imagecolorallocate($image, 18, 18, 24);
        $robe = imagecolorallocate($image, max($accent[0] - 25, 0), max($accent[1] - 25, 0), max($accent[2] - 25, 0));
        $robeLight = imagecolorallocatealpha($image, min($accent[0] + 35, 255), min($accent[1] + 35, 255), min($accent[2] + 35, 255), 18);
        $white = imagecolorallocatealpha($image, 255, 255, 255, 25);
        $blade = imagecolorallocate($image, 225, 238, 248);
        $shadow = imagecolorallocatealpha($image, 0, 0, 0, 65);

        $cx = $width / 2 + (($index % 2) ? 70 : -40);
        $headY = 770;

        imagefilledellipse($image, (int) $cx, $headY, 136, 154, $skin);
        imagefilledellipse($image, (int) $cx, $headY - 76, 155, 95, $hair);
        imagefilledrectangle($image, (int) $cx - 17, $headY + 70, (int) $cx + 17, $headY + 155, $skin);

        imagefilledpolygon($image, [
            (int) $cx - 210, 1040,
            (int) $cx - 115, 900,
            (int) $cx + 115, 900,
            (int) $cx + 230, 1045,
            (int) $cx + 315, 1610,
            (int) $cx - 315, 1610,
        ], 6, $robe);

        imagefilledpolygon($image, [
            (int) $cx - 48, 920,
            (int) $cx + 42, 920,
            (int) $cx + 95, 1585,
            (int) $cx - 105, 1585,
        ], 4, $robeLight);

        imagefilledpolygon($image, [(int) $cx - 220, 1010, 185, 1260, 245, 1330, (int) $cx - 80, 1120], 4, $robeLight);
        imagefilledpolygon($image, [(int) $cx + 220, 1010, 895, 1240, 845, 1325, (int) $cx + 80, 1120], 4, $robeLight);

        imagefilledellipse($image, 540, 1640, 520, 80, $shadow);

        if ($index !== 1) {
            imagesetthickness($image, 14);
            imageline($image, (int) $cx + 165, 700, (int) $cx + 340, 1390, $blade);
            imagesetthickness($image, 1);
            imagefilledellipse($image, (int) $cx + 245, 1020, 70, 70, $white);
        } else {
            imagefilledellipse($image, (int) $cx + 230, 1045, 150, 150, $white);
            imagearc($image, (int) $cx + 230, 1045, 210, 210, 0, 360, $blade);
        }

        for ($i = 0; $i < 11; $i++) {
            imagearc($image, (int) $cx, 1120 + $i * 34, 520 + $i * 24, 210 + $i * 8, 200, 342, $white);
        }
    }

    /**
     * @param array{title: string, character: string, role: string, text: string, visual_prompt: string, palette: array<int, array{0: int, 1: int, 2: int}>} $sceneData
     */
    private function drawFrameText($image, array $sceneData, int $index): void
    {
        $white = imagecolorallocate($image, 255, 255, 255);
        $muted = imagecolorallocate($image, 226, 232, 240);
        $panel = imagecolorallocatealpha($image, 0, 0, 0, 72);

        imagefilledrectangle($image, 84, 96, 996, 272, $panel);
        imagestring($image, 5, 118, 126, 'XIANXIA REVIEW', $white);
        imagestring($image, 4, 118, 174, sprintf('SCENE %02d', $index + 1), $muted);
        imagestring($image, 4, 118, 214, $this->asciiLabel($sceneData['character']), $white);

        imagefilledrectangle($image, 84, 1588, 996, 1768, $panel);
        imagestring($image, 5, 118, 1628, $this->asciiLabel($sceneData['title']), $white);
        imagestring($image, 4, 118, 1680, 'Character-focused short scene', $muted);
    }

    private function asciiLabel(string $value): string
    {
        return str_replace(
            ['Đ', 'đ', 'ạ', 'ậ', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'á', 'à', 'ả', 'ã', 'â', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
            ['D', 'd', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'i', 'i', 'i', 'i', 'i', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'],
            $value,
        );
    }
}
