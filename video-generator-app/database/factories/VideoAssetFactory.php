<?php

namespace Database\Factories;

use App\Enums\VideoAssetTypeEnum;
use App\Models\VideoAsset;
use App\Models\VideoProject;
use App\Models\VideoScene;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VideoAsset>
 */
class VideoAssetFactory extends Factory
{
    protected $model = VideoAsset::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video_project_id' => VideoProject::factory(),
            'video_scene_id' => VideoScene::factory(),
            'type' => VideoAssetTypeEnum::Image,
            'disk' => 'local',
            'path' => 'assets/mock-placeholder.txt',
            'source' => 'mock',
            'metadata' => [],
        ];
    }
}
