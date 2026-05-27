<?php

namespace Tests\Unit;

use App\Enums\VideoAssetTypeEnum;
use App\Enums\VideoSceneStatusEnum;
use App\Models\VideoProject;
use App\Services\MediaAssetSelectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaAssetSelectionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_mock_image_assets_for_project_scenes(): void
    {
        Storage::fake('local');

        $videoProject = VideoProject::factory()->create();
        $videoProject->scenes()->createMany([
            [
                'sort_order' => 1,
                'text' => 'Scene one',
                'duration_seconds' => 5,
                'visual_prompt' => 'Bright kitchen background',
                'status' => VideoSceneStatusEnum::Ready,
            ],
            [
                'sort_order' => 2,
                'text' => 'Scene two',
                'duration_seconds' => 5,
                'visual_prompt' => 'Close-up product shot',
                'status' => VideoSceneStatusEnum::Ready,
            ],
        ]);

        $assets = app(MediaAssetSelectionService::class)->selectForProject($videoProject->refresh());

        $this->assertCount(2, $assets);
        $this->assertTrue($assets->every(fn ($asset): bool => $asset->type === VideoAssetTypeEnum::Image));
        $this->assertSame('mock', $assets->first()->source);
        $this->assertSame('Bright kitchen background', $assets->first()->metadata['visual_prompt']);

        foreach ($assets as $asset) {
            Storage::disk($asset->disk)->assertExists($asset->path);
        }
    }
}
