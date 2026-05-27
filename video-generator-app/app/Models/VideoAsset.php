<?php

namespace App\Models;

use App\Enums\VideoAssetTypeEnum;
use Database\Factories\VideoAssetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'video_project_id',
    'video_scene_id',
    'type',
    'disk',
    'path',
    'source',
    'metadata',
])]
class VideoAsset extends Model
{
    /** @use HasFactory<VideoAssetFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => VideoAssetTypeEnum::class,
            'metadata' => 'array',
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
     * @return BelongsTo<VideoScene, $this>
     */
    public function videoScene(): BelongsTo
    {
        return $this->belongsTo(VideoScene::class);
    }
}
