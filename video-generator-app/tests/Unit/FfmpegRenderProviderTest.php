<?php

namespace Tests\Unit;

use App\Models\VideoProject;
use App\Models\VideoScene;
use App\Services\Rendering\FfmpegRenderProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Symfony\Component\Process\Process;
use Tests\TestCase;

class FfmpegRenderProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_builds_safe_ffmpeg_commands_for_vertical_mp4(): void
    {
        config([
            'video_pipeline.render.width' => 1080,
            'video_pipeline.render.height' => 1920,
            'video_pipeline.render.fps' => 30,
            'video_pipeline.render.preset' => 'veryfast',
        ]);

        $provider = new FfmpegRenderProvider;
        $command = $provider->buildFinalRenderCommand(
            '/tmp/input video.mp4',
            '/tmp/audio.m4a',
            '/tmp/subtitle.srt',
            '/tmp/output.mp4',
        );

        $this->assertSame('ffmpeg', $command[0]);
        $this->assertContains('-vf', $command);
        $this->assertContains('-map', $command);
        $this->assertContains('libx264', $command);
        $this->assertContains('aac', $command);
        $this->assertContains('yuv420p', $command);
        $this->assertContains('/tmp/output.mp4', $command);
    }

    public function test_fallback_audio_command_is_audible_not_silent_source(): void
    {
        $provider = new FfmpegRenderProvider;

        $command = $provider->buildFallbackAudioCommand('/tmp/fallback.m4a', 5);

        $this->assertContains('sine=frequency=432:sample_rate=44100', $command);
        $this->assertNotContains('anullsrc=channel_layout=stereo:sample_rate=44100', $command);
        $this->assertContains('volume=0.12', $command);
    }

    public function test_it_fails_clearly_when_ffmpeg_binary_is_missing(): void
    {
        config([
            'video_pipeline.render.ffmpeg_binary' => 'missing-ffmpeg-binary-for-test',
            'video_pipeline.render.ffprobe_binary' => 'missing-ffprobe-binary-for-test',
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('FFmpeg binary is not available.');

        app(FfmpegRenderProvider::class)->render(VideoProject::factory()->create());
    }

    public function test_it_can_render_a_short_real_mp4_when_ffmpeg_is_available(): void
    {
        $ffmpeg = $this->ffmpegBinary();
        $ffprobe = $this->ffprobeBinary();

        if (! $this->binaryIsAvailable($ffmpeg) || ! $this->binaryIsAvailable($ffprobe)) {
            $this->markTestSkipped('FFmpeg and FFprobe are required for real render integration.');
        }

        Storage::fake('local');

        config([
            'video_pipeline.render.ffmpeg_binary' => $ffmpeg,
            'video_pipeline.render.ffprobe_binary' => $ffprobe,
            'video_pipeline.storage.disk' => 'local',
            'video_pipeline.storage.output_disk' => 'local',
            'video_pipeline.render.min_duration_seconds' => 2,
            'video_pipeline.render.max_duration_seconds' => 2,
            'video_pipeline.render.width' => 180,
            'video_pipeline.render.height' => 320,
            'video_pipeline.render.fps' => 6,
            'video_pipeline.render.timeout' => 120,
            'video_pipeline.render.preset' => 'ultrafast',
        ]);

        $videoProject = VideoProject::factory()->create([
            'keyword' => 'real render smoke',
            'duration_seconds' => 2,
            'script_content' => 'Short render smoke script.',
        ]);
        VideoScene::factory()->create([
            'video_project_id' => $videoProject->id,
            'sort_order' => 1,
            'text' => 'Short render smoke subtitle.',
            'duration_seconds' => 2,
        ]);

        $renderedVideo = app(FfmpegRenderProvider::class)->render($videoProject->refresh());

        Storage::disk('local')->assertExists($renderedVideo->path);
        $this->assertSame('video/mp4', $renderedVideo->mimeType);
        $this->assertGreaterThanOrEqual(1.5, $renderedVideo->durationSeconds);
        $this->assertLessThanOrEqual(3.0, $renderedVideo->durationSeconds);
        $this->assertGreaterThan(0, $renderedVideo->sizeBytes);
        $this->assertTrue($renderedVideo->metadata['has_audio']);
        $this->assertSame('aac', $renderedVideo->metadata['audio_codec']);
        $this->assertNotNull($renderedVideo->metadata['audio_max_volume']);
    }

    private function binaryIsAvailable(string $binary): bool
    {
        $process = new Process([$binary, '-version']);
        $process->setTimeout(10);
        $process->run();

        return $process->isSuccessful();
    }

    private function ffmpegBinary(): string
    {
        $installerBinary = base_path('node_modules/@ffmpeg-installer/darwin-x64/ffmpeg');

        $this->ensureExecutable($installerBinary);

        return is_file($installerBinary) ? $installerBinary : 'ffmpeg';
    }

    private function ffprobeBinary(): string
    {
        $installerBinary = base_path('node_modules/@ffprobe-installer/darwin-x64/ffprobe');

        $this->ensureExecutable($installerBinary);

        return is_file($installerBinary) ? $installerBinary : 'ffprobe';
    }

    private function ensureExecutable(string $binary): void
    {
        if (is_file($binary) && ! is_executable($binary)) {
            chmod($binary, 0755);
        }
    }
}
