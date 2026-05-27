<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProjectFoundationTest extends TestCase
{
    public function test_video_pipeline_configuration_is_available(): void
    {
        $this->assertSame('AI Video Generator', config('app.name'));
        $this->assertSame('Asia/Ho_Chi_Minh', config('app.timezone'));
        $this->assertSame('video', config('video_pipeline.queue'));
        $this->assertSame('mock', config('video_pipeline.providers.script'));
        $this->assertSame('mock', config('video_pipeline.providers.image'));
        $this->assertSame('mock', config('video_pipeline.providers.tts'));
        $this->assertSame(1080, config('video_pipeline.render.width'));
        $this->assertSame(1920, config('video_pipeline.render.height'));
        $this->assertSame('9:16', config('video_pipeline.render.aspect_ratio'));
    }

    public function test_video_storage_directories_exist(): void
    {
        foreach (config('video_pipeline.storage.directories') as $directory) {
            $this->assertTrue(
                File::isDirectory(storage_path("app/{$directory}")),
                "Expected storage/app/{$directory} to exist."
            );
        }
    }
}
