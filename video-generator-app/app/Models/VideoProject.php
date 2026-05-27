<?php

namespace App\Models;

use App\Enums\VideoProjectStatusEnum;
use Database\Factories\VideoProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'keyword',
    'content_brief',
    'tone',
    'duration_seconds',
    'platform',
    'language',
    'status',
    'progress_percent',
    'error_message',
    'script_content',
    'audio_disk',
    'audio_path',
    'audio_duration_seconds',
    'subtitle_disk',
    'subtitle_path',
    'rendered_video_path',
    'output_disk',
    'render_duration_seconds',
    'render_size_bytes',
    'render_metadata',
])]
class VideoProject extends Model
{
    /** @use HasFactory<VideoProjectFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration_seconds' => 'integer',
            'progress_percent' => 'integer',
            'audio_duration_seconds' => 'decimal:2',
            'render_duration_seconds' => 'decimal:2',
            'render_size_bytes' => 'integer',
            'render_metadata' => 'array',
            'status' => VideoProjectStatusEnum::class,
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<VideoScene, $this>
     */
    public function scenes(): HasMany
    {
        return $this->hasMany(VideoScene::class)->orderBy('sort_order');
    }

    /**
     * @return HasMany<VideoAsset, $this>
     */
    public function assets(): HasMany
    {
        return $this->hasMany(VideoAsset::class);
    }

    /**
     * @return Attribute<string, never>
     */
    protected function platformLabel(): Attribute
    {
        return Attribute::get(fn (): string => match ($this->platform) {
            'tiktok' => 'TikTok',
            'youtube_shorts' => 'YouTube Shorts',
            'facebook_reels' => 'Facebook Reels',
            default => ucfirst(str_replace('_', ' ', (string) $this->platform)),
        });
    }

    /**
     * @return Attribute<string, never>
     */
    protected function languageLabel(): Attribute
    {
        return Attribute::get(fn (): string => match ($this->language) {
            'vi' => 'Vietnamese',
            'en' => 'English',
            default => strtoupper((string) $this->language),
        });
    }

    /**
     * @return Attribute<string, never>
     */
    protected function durationLabel(): Attribute
    {
        return Attribute::get(function (): string {
            $minutes = intdiv($this->duration_seconds, 60);
            $seconds = $this->duration_seconds % 60;

            if ($minutes === 0) {
                return "{$seconds}s";
            }

            return $seconds === 0 ? "{$minutes}m" : "{$minutes}m {$seconds}s";
        });
    }

    public function outputDisk(): string
    {
        return $this->output_disk ?: (string) config('video_pipeline.storage.output_disk');
    }

    public function hasPlayableVideoOutput(): bool
    {
        if (! $this->rendered_video_path) {
            return false;
        }

        $extension = strtolower(pathinfo($this->rendered_video_path, PATHINFO_EXTENSION));
        $mimeType = $this->render_metadata['mime_type'] ?? null;

        return $extension === 'mp4' || $mimeType === 'video/mp4';
    }

    /**
     * @return Attribute<string, never>
     */
    protected function renderDurationLabel(): Attribute
    {
        return Attribute::get(function (): string {
            if ($this->render_duration_seconds === null) {
                return 'Unknown';
            }

            $seconds = (int) round((float) $this->render_duration_seconds);
            $minutes = intdiv($seconds, 60);
            $remainingSeconds = $seconds % 60;

            return $minutes > 0 ? sprintf('%dm %02ds', $minutes, $remainingSeconds) : "{$remainingSeconds}s";
        });
    }

    /**
     * @return Attribute<string, never>
     */
    protected function renderSizeLabel(): Attribute
    {
        return Attribute::get(function (): string {
            if (! $this->render_size_bytes) {
                return 'Unknown';
            }

            if ($this->render_size_bytes >= 1024 * 1024) {
                return round($this->render_size_bytes / 1024 / 1024, 1).' MB';
            }

            return round($this->render_size_bytes / 1024, 1).' KB';
        });
    }

    /**
     * @return Attribute<string, never>
     */
    protected function renderResolutionLabel(): Attribute
    {
        return Attribute::get(function (): string {
            $width = $this->render_metadata['width'] ?? null;
            $height = $this->render_metadata['height'] ?? null;

            return $width && $height ? "{$width}x{$height}" : 'Unknown';
        });
    }

    /**
     * @return array<int, array{key: string, label: string, complete: bool, active: bool}>
     */
    public function pipelineSteps(): array
    {
        $steps = [
            ['key' => 'script', 'label' => 'Script', 'threshold' => 25],
            ['key' => 'scenes', 'label' => 'Scenes', 'threshold' => 45],
            ['key' => 'media', 'label' => 'Media', 'threshold' => 60],
            ['key' => 'voice', 'label' => 'Voice', 'threshold' => 75],
            ['key' => 'subtitle', 'label' => 'Subtitle', 'threshold' => 85],
            ['key' => 'render', 'label' => 'Render', 'threshold' => 100],
        ];

        return array_map(function (array $step): array {
            $complete = $this->status === VideoProjectStatusEnum::Completed
                || $this->progress_percent >= $step['threshold'];

            return [
                'key' => $step['key'],
                'label' => $step['label'],
                'complete' => $complete,
                'active' => ! $complete && ! $this->status->isFinished(),
            ];
        }, $steps);
    }
}
