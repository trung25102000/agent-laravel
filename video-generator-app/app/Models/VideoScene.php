<?php

namespace App\Models;

use App\Enums\VideoSceneStatusEnum;
use Database\Factories\VideoSceneFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'video_project_id',
    'sort_order',
    'text',
    'duration_seconds',
    'visual_prompt',
    'status',
])]
class VideoScene extends Model
{
    /** @use HasFactory<VideoSceneFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration_seconds' => 'decimal:2',
            'status' => VideoSceneStatusEnum::class,
        ];
    }

    /**
     * @return BelongsTo<VideoProject, $this>
     */
    public function videoProject(): BelongsTo
    {
        return $this->belongsTo(VideoProject::class);
    }

    /**
     * @return HasMany<VideoAsset, $this>
     */
    public function assets(): HasMany
    {
        return $this->hasMany(VideoAsset::class);
    }
}
