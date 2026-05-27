<?php

namespace Database\Factories;

use App\Enums\VideoProjectStatusEnum;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VideoProject>
 */
class VideoProjectFactory extends Factory
{
    protected $model = VideoProject::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'keyword' => fake()->words(3, true),
            'content_brief' => fake()->sentence(),
            'tone' => fake()->randomElement(['educational', 'funny', 'inspiring', 'neutral']),
            'duration_seconds' => fake()->randomElement([15, 30, 45, 60]),
            'platform' => fake()->randomElement(['tiktok', 'youtube_shorts', 'facebook_reels']),
            'language' => fake()->randomElement(['vi', 'en']),
            'status' => VideoProjectStatusEnum::Draft,
            'progress_percent' => 0,
        ];
    }
}
