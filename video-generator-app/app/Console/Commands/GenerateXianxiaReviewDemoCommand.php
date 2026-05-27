<?php

namespace App\Console\Commands;

use App\Services\Rendering\Contracts\RenderProviderInterface;
use App\Services\VideoRenderService;
use App\Services\XianxiaReviewDemoService;
use Illuminate\Console\Command;

class GenerateXianxiaReviewDemoCommand extends Command
{
    protected $signature = 'demo:xianxia-review
        {--email=demo@example.com : Demo user email}
        {--password=password : Demo user password}
        {--project-id= : Existing demo project ID to replace}
        {--reference-url= : Visual reference URL stored in metadata}
        {--audio-mode=generated : Demo audio mode}
        {--replace-project-output : Replace the existing project output}
        {--skip-render : Create project, scenes, and character assets without FFmpeg rendering}
        {--ffmpeg= : FFmpeg binary path}
        {--ffprobe= : FFprobe binary path}';

    protected $description = 'Create a playable xianxia review demo video with scene-specific character assets.';

    public function handle(XianxiaReviewDemoService $demoService): int
    {
        $projectId = $this->option('project-id') ? (int) $this->option('project-id') : null;

        $result = $demoService->createOrUpdate(
            email: (string) $this->option('email'),
            password: (string) $this->option('password'),
            projectId: $projectId,
            referenceUrl: (string) ($this->option('reference-url') ?: 'https://www.youtube.com/watch?v=5W-8VZa1jpw'),
        );

        $project = $result['project'];

        if ($this->option('skip-render')) {
            $this->info("Prepared xianxia demo project #{$project->id} with scene character assets.");
            $this->line("Audio: {$project->audio_path}");

            return self::SUCCESS;
        }

        $ffmpeg = $this->resolveBinary('ffmpeg', 'node_modules/@ffmpeg-installer/darwin-x64/ffmpeg');
        $ffprobe = $this->resolveBinary('ffprobe', 'node_modules/@ffprobe-installer/darwin-x64/ffprobe');

        if (! is_file($ffmpeg) || ! is_executable($ffmpeg)) {
            $this->error('FFmpeg binary is not available. Pass --ffmpeg or install ffmpeg.');

            return self::FAILURE;
        }

        if (! is_file($ffprobe) || ! is_executable($ffprobe)) {
            $this->error('FFprobe binary is not available. Pass --ffprobe or install ffprobe.');

            return self::FAILURE;
        }

        config([
            'video_pipeline.providers.render' => 'ffmpeg',
            'video_pipeline.render.ffmpeg_binary' => $ffmpeg,
            'video_pipeline.render.ffprobe_binary' => $ffprobe,
            'video_pipeline.render.min_duration_seconds' => 180,
            'video_pipeline.render.max_duration_seconds' => 240,
        ]);

        app()->forgetInstance(RenderProviderInterface::class);

        $completedProject = app(VideoRenderService::class)->render($project->refresh());
        $metadata = $completedProject->render_metadata ?? [];

        $this->info("Rendered xianxia review project #{$completedProject->id}.");
        $this->line("Preview: ".route('video-projects.preview', $completedProject));
        $this->line("Output: {$completedProject->rendered_video_path}");
        $this->line("Audio: {$completedProject->audio_path}");
        $this->line('Audio stream: '.json_encode([
            'has_audio' => $metadata['has_audio'] ?? false,
            'audio_codec' => $metadata['audio_codec'] ?? null,
            'audio_duration_seconds' => $metadata['audio_duration_seconds'] ?? null,
            'audio_max_volume' => $metadata['audio_max_volume'] ?? null,
        ], JSON_UNESCAPED_SLASHES));

        return self::SUCCESS;
    }

    private function resolveBinary(string $option, string $localFallback): string
    {
        $configured = $this->option($option);

        if ($configured) {
            return (string) $configured;
        }

        $localBinary = base_path($localFallback);

        if (is_file($localBinary)) {
            return $localBinary;
        }

        return (string) config("video_pipeline.render.{$option}_binary", $option);
    }
}
