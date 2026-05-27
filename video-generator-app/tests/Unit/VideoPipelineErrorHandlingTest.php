<?php

namespace Tests\Unit;

use App\Enums\VideoProjectStatusEnum;
use App\Exceptions\PipelineException;
use App\Jobs\RenderVideoJob;
use App\Models\VideoProject;
use App\Services\Rendering\Contracts\RenderProviderInterface;
use App\Services\VideoRenderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Tests\TestCase;

class VideoPipelineErrorHandlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_render_service_marks_project_failed_and_throws_pipeline_exception(): void
    {
        $this->app->bind(RenderProviderInterface::class, fn () => new class implements RenderProviderInterface {
            public function render(VideoProject $videoProject): \App\DTOs\RenderedVideo
            {
                throw new RuntimeException('Sensitive provider stack detail');
            }
        });

        $videoProject = VideoProject::factory()->create([
            'progress_percent' => 70,
        ]);

        $this->expectException(PipelineException::class);
        $this->expectExceptionMessage('Video render failed.');

        try {
            app(VideoRenderService::class)->render($videoProject);
        } finally {
            $videoProject->refresh();
            $this->assertSame(VideoProjectStatusEnum::Failed, $videoProject->status);
            $this->assertSame('Render step failed.', $videoProject->error_message);
        }
    }

    public function test_render_job_failed_hook_marks_project_failed(): void
    {
        $videoProject = VideoProject::factory()->create([
            'progress_percent' => 90,
        ]);

        (new RenderVideoJob($videoProject->id))->failed(new RuntimeException('Queue worker failure'));

        $videoProject->refresh();
        $this->assertSame(VideoProjectStatusEnum::Failed, $videoProject->status);
        $this->assertSame('Render job failed.', $videoProject->error_message);
    }
}
