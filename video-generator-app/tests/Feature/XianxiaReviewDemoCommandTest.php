<?php

namespace Tests\Feature;

use App\Enums\VideoAssetTypeEnum;
use App\Models\User;
use App\Models\VideoProject;
use App\Models\VideoScene;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class XianxiaReviewDemoCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_prepares_xianxia_project_scene_assets_without_rendering(): void
    {
        Storage::fake('local');

        $this->artisan('demo:xianxia-review', [
            '--email' => 'demo@example.com',
            '--password' => 'password',
            '--skip-render' => true,
        ])->assertSuccessful();

        $user = User::where('email', 'demo@example.com')->firstOrFail();
        $project = VideoProject::where('user_id', $user->id)->firstOrFail();

        $this->assertSame('Review truyện tiên hiệp: Kiếm Đạo Trường Sinh', $project->keyword);
        $this->assertSame('videos/video-projects/'.$project->id.'/xianxia-review/generated-voice.wav', $project->audio_path);
        $this->assertSame('180.00', (string) $project->audio_duration_seconds);
        Storage::disk((string) $project->audio_disk)->assertExists($project->audio_path);
        $this->assertSame(6, VideoScene::where('video_project_id', $project->id)->count());

        $assets = $project->assets()->where('type', VideoAssetTypeEnum::Image)->get();
        $voiceAsset = $project->assets()->where('type', VideoAssetTypeEnum::Voice)->first();

        $this->assertCount(6, $assets);
        $this->assertNotNull($voiceAsset);
        $this->assertSame('generated_audible_demo', $voiceAsset->source);
        $this->assertSame('audio/wav', $voiceAsset->metadata['mime_type']);
        $this->assertFalse($voiceAsset->metadata['silent']);
        $this->assertSame('https://www.youtube.com/watch?v=5W-8VZa1jpw', $voiceAsset->metadata['reference_url']);

        foreach ($assets as $asset) {
            Storage::disk($asset->disk)->assertExists($asset->path);
            $this->assertSame('reference_inspired_original', $asset->source);
            $this->assertSame('image/png', $asset->metadata['mime_type']);
            $this->assertNotEmpty($asset->metadata['character']);
            $this->assertNotEmpty($asset->metadata['role']);
            $this->assertSame('https://www.youtube.com/watch?v=5W-8VZa1jpw', $asset->metadata['reference_url']);
        }
    }

    public function test_command_can_replace_an_existing_demo_project(): void
    {
        Storage::fake('local');

        $user = User::factory()->create(['email' => 'demo@example.com']);
        $project = VideoProject::factory()->for($user)->create([
            'keyword' => 'Old demo',
        ]);

        $this->artisan('demo:xianxia-review', [
            '--email' => 'demo@example.com',
            '--password' => 'password',
            '--project-id' => $project->id,
            '--skip-render' => true,
        ])->assertSuccessful();

        $project->refresh();

        $this->assertSame('Review truyện tiên hiệp: Kiếm Đạo Trường Sinh', $project->keyword);
        $this->assertSame(6, $project->scenes()->count());
        $this->assertSame(6, $project->assets()->where('type', VideoAssetTypeEnum::Image)->count());
        $this->assertSame(1, $project->assets()->where('type', VideoAssetTypeEnum::Voice)->count());
    }

    public function test_command_stores_custom_reference_url_metadata(): void
    {
        Storage::fake('local');

        $referenceUrl = 'https://www.youtube.com/watch?v=5W-8VZa1jpw';

        $this->artisan('demo:xianxia-review', [
            '--email' => 'demo@example.com',
            '--password' => 'password',
            '--reference-url' => $referenceUrl,
            '--skip-render' => true,
        ])->assertSuccessful();

        $project = VideoProject::firstOrFail();
        $asset = $project->assets()->where('type', VideoAssetTypeEnum::Image)->firstOrFail();

        $this->assertSame($referenceUrl, $project->render_metadata['reference_url']);
        $this->assertSame('reference_inspired_original', $project->render_metadata['visual_source']);
        $this->assertSame($referenceUrl, $asset->metadata['reference_url']);
    }
}
