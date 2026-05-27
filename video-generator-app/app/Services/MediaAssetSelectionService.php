<?php

namespace App\Services;

use App\Enums\VideoAssetTypeEnum;
use App\Models\VideoAsset;
use App\Models\VideoProject;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MediaAssetSelectionService
{
    /**
     * @return EloquentCollection<int, VideoAsset>
     */
    public function selectForProject(VideoProject $videoProject): EloquentCollection
    {
        $disk = config('video_pipeline.storage.disk');

        return DB::transaction(function () use ($videoProject, $disk): EloquentCollection {
            $videoProject->assets()->where('type', VideoAssetTypeEnum::Image)->delete();

            foreach ($videoProject->scenes as $scene) {
                $path = "assets/video-projects/{$videoProject->id}/scene-{$scene->sort_order}.txt";

                Storage::disk($disk)->put($path, $scene->visual_prompt);

                $videoProject->assets()->create([
                    'video_scene_id' => $scene->id,
                    'type' => VideoAssetTypeEnum::Image,
                    'disk' => $disk,
                    'path' => $path,
                    'source' => 'mock',
                    'metadata' => [
                        'visual_prompt' => $scene->visual_prompt,
                        'placeholder' => true,
                    ],
                ]);
            }

            return $videoProject->refresh()->assets()->where('type', VideoAssetTypeEnum::Image)->get();
        });
    }
}
