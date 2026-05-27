<?php

namespace Database\Factories;

use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use App\Models\VideoScene;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VideoScene>
 */
class VideoSceneFactory extends Factory
{
    protected $model = VideoScene::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video_project_id' => VideoProject::factory(),
            'sort_order' => 1,
            'text' => fake()->sentence(),
            'duration_seconds' => 5.0,
            'visual_prompt' => fake()->sentence(),
            'status' => VideoSceneStatusEnum::Ready,
        ];
    }
}
