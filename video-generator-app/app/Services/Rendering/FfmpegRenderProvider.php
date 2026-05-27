<?php

namespace App\Services\Rendering;

use App\DTOs\RenderedVideo;
use App\Enums\VideoAssetTypeEnum;
use App\Models\VideoProject;
use App\Models\VideoScene;
use App\Services\Rendering\Contracts\RenderProviderInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Symfony\Component\Process\Process;

class FfmpegRenderProvider implements RenderProviderInterface
{
    public function render(VideoProject $videoProject): RenderedVideo
    {
        $this->assertBinaryIsAvailable($this->ffmpegBinary(), 'FFmpeg');
        $this->assertBinaryIsAvailable($this->ffprobeBinary(), 'FFprobe');

        $disk = (string) config('video_pipeline.storage.output_disk');
        $basePath = "videos/video-projects/{$videoProject->id}";
        $workPath = "{$basePath}/render-work";
        $outputPath = "{$basePath}/output.mp4";
        $workDirectory = Storage::disk($disk)->path($workPath);
        $outputFile = Storage::disk($disk)->path($outputPath);

        if (! is_dir($workDirectory) && ! mkdir($workDirectory, 0755, true) && ! is_dir($workDirectory)) {
            throw new RuntimeException('Unable to create render work directory.');
        }

        $videoProject->loadMissing(['scenes.assets', 'assets']);

        $scenePayloads = $this->scenePayloads($videoProject);
        $imageFiles = $this->prepareImages($videoProject, $scenePayloads, $disk, $workDirectory);
        $audioFile = $this->prepareAudio($videoProject, $workDirectory, $this->targetDuration($videoProject));
        $subtitleFile = $this->prepareSubtitle($scenePayloads, $workDirectory);
        $segmentFiles = $this->renderSegments($scenePayloads, $imageFiles, $workDirectory);
        $concatList = $this->writeConcatList($segmentFiles, "{$workDirectory}/concat.txt");
        $stitchedVideo = "{$workDirectory}/stitched.mp4";

        $this->runCommand($this->buildConcatCommand($concatList, $stitchedVideo), 'concat_video');
        $this->runCommand($this->buildFinalRenderCommand($stitchedVideo, $audioFile, $subtitleFile, $outputFile), 'final_render');

        $duration = $this->probeDuration($outputFile);
        $mediaInfo = $this->probeMedia($outputFile);
        $audioVolume = $this->probeAudioVolume($outputFile);
        $audioStream = $this->firstAudioStream($mediaInfo);

        if ($audioStream === null) {
            throw new RuntimeException('Rendered video is missing an audio stream.');
        }

        $size = is_file($outputFile) ? filesize($outputFile) : null;

        return new RenderedVideo(
            disk: $disk,
            path: $outputPath,
            mimeType: 'video/mp4',
            durationSeconds: $duration,
            sizeBytes: $size === false ? null : $size,
            metadata: [
                'provider' => 'ffmpeg',
                'width' => $this->width(),
                'height' => $this->height(),
                'fps' => $this->fps(),
                'target_duration_seconds' => $this->targetDuration($videoProject),
                'scene_count' => count($scenePayloads),
                'has_audio' => true,
                'audio_codec' => $audioStream['codec_name'] ?? null,
                'audio_duration_seconds' => isset($audioStream['duration']) ? round((float) $audioStream['duration'], 2) : null,
                'audio_max_volume' => $audioVolume['max_volume'] ?? null,
                'audio_mean_volume' => $audioVolume['mean_volume'] ?? null,
                'reference_url' => $videoProject->render_metadata['reference_url'] ?? null,
                'visual_source' => $videoProject->render_metadata['visual_source'] ?? null,
            ],
        );
    }

    /**
     * @return array<int, array{key: int, text: string, visual_prompt: string, duration: float, scene: ?VideoScene}>
     */
    private function scenePayloads(VideoProject $videoProject): array
    {
        /** @var Collection<int, VideoScene> $scenes */
        $scenes = $videoProject->scenes->values();
        $targetDuration = $this->targetDuration($videoProject);

        if ($scenes->isEmpty()) {
            return [[
                'key' => 1,
                'text' => $videoProject->script_content ?: $videoProject->keyword,
                'visual_prompt' => $videoProject->keyword,
                'duration' => (float) $targetDuration,
                'scene' => null,
            ]];
        }

        $durationPerScene = round($targetDuration / $scenes->count(), 2);

        return $scenes
            ->map(fn (VideoScene $scene): array => [
                'key' => (int) $scene->sort_order,
                'text' => $scene->text,
                'visual_prompt' => $scene->visual_prompt ?: $scene->text,
                'duration' => $durationPerScene,
                'scene' => $scene,
            ])
            ->all();
    }

    /**
     * @param  array<int, array{key: int, text: string, visual_prompt: string, duration: float, scene: ?VideoScene}>  $scenePayloads
     * @return array<int, string>
     */
    private function prepareImages(VideoProject $videoProject, array $scenePayloads, string $disk, string $workDirectory): array
    {
        $imageFiles = [];

        foreach ($scenePayloads as $index => $payload) {
            $existingImage = $this->existingSceneImage($payload['scene']);

            if ($existingImage !== null) {
                $imageFiles[] = $existingImage;

                continue;
            }

            $fallbackPath = "videos/video-projects/{$videoProject->id}/fallback-assets/scene-{$payload['key']}.jpg";
            $fallbackFile = Storage::disk($disk)->path($fallbackPath);
            $fallbackDirectory = dirname($fallbackFile);

            if (! is_dir($fallbackDirectory) && ! mkdir($fallbackDirectory, 0755, true) && ! is_dir($fallbackDirectory)) {
                throw new RuntimeException('Unable to create fallback asset directory.');
            }

            $this->runCommand($this->buildFallbackImageCommand($fallbackFile, $index), 'fallback_image');

            if ($payload['scene'] instanceof VideoScene) {
                $videoProject->assets()->updateOrCreate(
                    [
                        'video_scene_id' => $payload['scene']->id,
                        'type' => VideoAssetTypeEnum::Image,
                    ],
                    [
                        'disk' => $disk,
                        'path' => $fallbackPath,
                        'source' => 'ffmpeg_fallback',
                        'metadata' => [
                            'visual_prompt' => $payload['visual_prompt'],
                            'mime_type' => 'image/jpeg',
                            'placeholder' => true,
                        ],
                    ],
                );
            }

            $imageFiles[] = $fallbackFile;
        }

        return $imageFiles;
    }

    private function existingSceneImage(?VideoScene $scene): ?string
    {
        if (! $scene instanceof VideoScene) {
            return null;
        }

        $asset = $scene->assets
            ->first(fn ($asset): bool => $asset->type === VideoAssetTypeEnum::Image && $this->isUsableImagePath($asset->path));

        if (! $asset) {
            return null;
        }

        $path = Storage::disk($asset->disk)->path($asset->path);

        return is_file($path) ? $path : null;
    }

    private function isUsableImagePath(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    private function prepareAudio(VideoProject $videoProject, string $workDirectory, int $targetDuration): string
    {
        if ($videoProject->audio_path && $this->isUsableAudioPath($videoProject->audio_path)) {
            $disk = $videoProject->audio_disk ?: config('video_pipeline.storage.disk');
            $path = Storage::disk($disk)->path($videoProject->audio_path);

            if (is_file($path)) {
                return $path;
            }
        }

        $audioFile = "{$workDirectory}/fallback-voice.m4a";
        $this->runCommand($this->buildFallbackAudioCommand($audioFile, $targetDuration), 'fallback_audio');

        return $audioFile;
    }

    private function isUsableAudioPath(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['aac', 'aif', 'aiff', 'm4a', 'mp3', 'wav'], true);
    }

    /**
     * @param  array<int, array{key: int, text: string, visual_prompt: string, duration: float, scene: ?VideoScene}>  $scenePayloads
     */
    private function prepareSubtitle(array $scenePayloads, string $workDirectory): string
    {
        $subtitleFile = "{$workDirectory}/subtitles.srt";
        $cursor = 0.0;
        $blocks = [];

        foreach ($scenePayloads as $index => $payload) {
            $start = $cursor;
            $end = $cursor + $payload['duration'];
            $cursor = $end;
            $blocks[] = implode("\n", [
                (string) ($index + 1),
                $this->formatTimestamp($start).' --> '.$this->formatTimestamp($end),
                trim($payload['text']),
            ]);
        }

        file_put_contents($subtitleFile, implode("\n\n", $blocks)."\n");

        return $subtitleFile;
    }

    /**
     * @param  array<int, array{key: int, text: string, visual_prompt: string, duration: float, scene: ?VideoScene}>  $scenePayloads
     * @param  array<int, string>  $imageFiles
     * @return array<int, string>
     */
    private function renderSegments(array $scenePayloads, array $imageFiles, string $workDirectory): array
    {
        $segmentFiles = [];

        foreach ($scenePayloads as $index => $payload) {
            $segmentFile = sprintf('%s/segment-%03d.mp4', $workDirectory, $index + 1);
            $this->runCommand(
                $this->buildSegmentCommand($imageFiles[$index], $segmentFile, $payload['duration']),
                'segment_render',
            );
            $segmentFiles[] = $segmentFile;
        }

        return $segmentFiles;
    }

    /**
     * @param  array<int, string>  $segmentFiles
     */
    private function writeConcatList(array $segmentFiles, string $concatList): string
    {
        $lines = array_map(fn (string $file): string => "file '".$this->escapeConcatPath($file)."'", $segmentFiles);
        file_put_contents($concatList, implode("\n", $lines)."\n");

        return $concatList;
    }

    /**
     * @return array<int, string>
     */
    public function buildFallbackImageCommand(string $outputFile, int $index = 0): array
    {
        $colors = ['0x111827', '0x14532d', '0x7c2d12', '0x1e3a8a'];

        return [
            $this->ffmpegBinary(),
            '-y',
            '-f',
            'lavfi',
            '-i',
            sprintf('color=c=%s:s=%dx%d:d=1', $colors[$index % count($colors)], $this->width(), $this->height()),
            '-frames:v',
            '1',
            $outputFile,
        ];
    }

    /**
     * @return array<int, string>
     */
    public function buildFallbackAudioCommand(string $outputFile, int $durationSeconds): array
    {
        return [
            $this->ffmpegBinary(),
            '-y',
            '-f',
            'lavfi',
            '-t',
            (string) $durationSeconds,
            '-i',
            'sine=frequency=432:sample_rate=44100',
            '-filter:a',
            'volume=0.12',
            '-c:a',
            'aac',
            '-b:a',
            '128k',
            $outputFile,
        ];
    }

    /**
     * @return array<int, string>
     */
    public function buildSegmentCommand(string $imageFile, string $segmentFile, float $durationSeconds): array
    {
        return [
            $this->ffmpegBinary(),
            '-y',
            '-loop',
            '1',
            '-t',
            (string) $durationSeconds,
            '-i',
            $imageFile,
            '-vf',
            sprintf(
                'scale=%d:%d:force_original_aspect_ratio=increase,crop=%d:%d,fps=%d,format=yuv420p',
                $this->width(),
                $this->height(),
                $this->width(),
                $this->height(),
                $this->fps(),
            ),
            '-an',
            '-c:v',
            'libx264',
            '-preset',
            $this->preset(),
            '-pix_fmt',
            'yuv420p',
            $segmentFile,
        ];
    }

    /**
     * @return array<int, string>
     */
    public function buildConcatCommand(string $concatList, string $outputFile): array
    {
        return [
            $this->ffmpegBinary(),
            '-y',
            '-f',
            'concat',
            '-safe',
            '0',
            '-i',
            $concatList,
            '-c',
            'copy',
            $outputFile,
        ];
    }

    /**
     * @return array<int, string>
     */
    public function buildFinalRenderCommand(string $videoFile, string $audioFile, string $subtitleFile, string $outputFile): array
    {
        return [
            $this->ffmpegBinary(),
            '-y',
            '-i',
            $videoFile,
            '-i',
            $audioFile,
            '-vf',
            'subtitles='.$this->escapeSubtitlePath($subtitleFile),
            '-map',
            '0:v:0',
            '-map',
            '1:a:0',
            '-shortest',
            '-c:v',
            'libx264',
            '-preset',
            $this->preset(),
            '-af',
            'apad,loudnorm=I=-14:TP=-1.5:LRA=11',
            '-c:a',
            'aac',
            '-b:a',
            '128k',
            '-pix_fmt',
            'yuv420p',
            $outputFile,
        ];
    }

    /**
     * @param  array<int, string>  $command
     */
    private function runCommand(array $command, string $step): void
    {
        $process = new Process($command);
        $process->setTimeout($this->timeout());
        $process->run();

        Log::info('FFmpeg command completed.', [
            'step' => $step,
            'command' => $this->sanitizeCommand($command),
            'exit_code' => $process->getExitCode(),
        ]);

        if (! $process->isSuccessful()) {
            Log::error('FFmpeg command failed.', [
                'step' => $step,
                'command' => $this->sanitizeCommand($command),
                'exit_code' => $process->getExitCode(),
                'stderr' => mb_substr($process->getErrorOutput(), 0, 2000),
            ]);

            throw new RuntimeException("FFmpeg {$step} failed.");
        }
    }

    private function assertBinaryIsAvailable(string $binary, string $label): void
    {
        $process = new Process([$binary, '-version']);
        $process->setTimeout(10);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new RuntimeException("{$label} binary is not available.");
        }
    }

    private function probeDuration(string $outputFile): ?float
    {
        $process = new Process([
            $this->ffprobeBinary(),
            '-v',
            'error',
            '-show_entries',
            'format=duration',
            '-of',
            'default=noprint_wrappers=1:nokey=1',
            $outputFile,
        ]);
        $process->setTimeout(30);
        $process->run();

        if (! $process->isSuccessful()) {
            return null;
        }

        return round((float) trim($process->getOutput()), 2);
    }

    /**
     * @return array<string, mixed>
     */
    public function probeMedia(string $file): array
    {
        $process = new Process([
            $this->ffprobeBinary(),
            '-v',
            'error',
            '-show_streams',
            '-show_format',
            '-print_format',
            'json',
            $file,
        ]);
        $process->setTimeout(30);
        $process->run();

        if (! $process->isSuccessful()) {
            return [];
        }

        $decoded = json_decode($process->getOutput(), true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * @param  array<string, mixed>  $mediaInfo
     * @return array<string, mixed>|null
     */
    private function firstAudioStream(array $mediaInfo): ?array
    {
        foreach (($mediaInfo['streams'] ?? []) as $stream) {
            if (is_array($stream) && ($stream['codec_type'] ?? null) === 'audio') {
                return $stream;
            }
        }

        return null;
    }

    /**
     * @return array{mean_volume?: string, max_volume?: string}
     */
    private function probeAudioVolume(string $file): array
    {
        $process = new Process([
            $this->ffmpegBinary(),
            '-i',
            $file,
            '-af',
            'volumedetect',
            '-f',
            'null',
            '-',
        ]);
        $process->setTimeout(60);
        $process->run();

        if (! $process->isSuccessful()) {
            return [];
        }

        $stderr = $process->getErrorOutput();
        $volume = [];

        if (preg_match('/mean_volume:\s*([^\\n]+)/', $stderr, $matches)) {
            $volume['mean_volume'] = trim($matches[1]);
        }

        if (preg_match('/max_volume:\s*([^\\n]+)/', $stderr, $matches)) {
            $volume['max_volume'] = trim($matches[1]);
        }

        return $volume;
    }

    private function targetDuration(VideoProject $videoProject): int
    {
        $min = (int) config('video_pipeline.render.min_duration_seconds', 180);
        $max = (int) config('video_pipeline.render.max_duration_seconds', 240);
        $requested = max((int) $videoProject->duration_seconds, $min);

        return min($requested, $max);
    }

    private function formatTimestamp(float $seconds): string
    {
        $milliseconds = (int) round(($seconds - floor($seconds)) * 1000);
        $totalSeconds = (int) floor($seconds);
        $hours = intdiv($totalSeconds, 3600);
        $minutes = intdiv($totalSeconds % 3600, 60);
        $remainingSeconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d,%03d', $hours, $minutes, $remainingSeconds, $milliseconds);
    }

    private function escapeConcatPath(string $path): string
    {
        return str_replace("'", "'\\''", $path);
    }

    private function escapeSubtitlePath(string $path): string
    {
        return str_replace(['\\', ':', "'", ','], ['\\\\', '\\:', "\\'", '\\,'], $path);
    }

    /**
     * @param  array<int, string>  $command
     * @return array<int, string>
     */
    private function sanitizeCommand(array $command): array
    {
        $storageRoot = Storage::disk((string) config('video_pipeline.storage.output_disk'))->path('');

        return array_map(
            fn (string $part): string => str_replace($storageRoot, '{storage}/', $part),
            $command,
        );
    }

    private function ffmpegBinary(): string
    {
        return (string) config('video_pipeline.render.ffmpeg_binary', 'ffmpeg');
    }

    private function ffprobeBinary(): string
    {
        return (string) config('video_pipeline.render.ffprobe_binary', 'ffprobe');
    }

    private function width(): int
    {
        return (int) config('video_pipeline.render.width', 1080);
    }

    private function height(): int
    {
        return (int) config('video_pipeline.render.height', 1920);
    }

    private function fps(): int
    {
        return (int) config('video_pipeline.render.fps', 30);
    }

    private function timeout(): int
    {
        return (int) config('video_pipeline.render.timeout', 1200);
    }

    private function preset(): string
    {
        return (string) config('video_pipeline.render.preset', 'veryfast');
    }
}
