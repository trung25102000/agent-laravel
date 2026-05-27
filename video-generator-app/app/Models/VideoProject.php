<?php

namespace App\Models;

use App\Enums\VideoProjectStatusEnum;
use Database\Factories\VideoProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
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
}
