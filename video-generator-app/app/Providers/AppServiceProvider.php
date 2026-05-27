<?php

namespace App\Providers;

use App\Events\VideoProjectCompleted;
use App\Listeners\SendVideoProjectCompletedNotification;
use App\Services\AI\Contracts\ScriptGeneratorInterface;
use App\Services\AI\Contracts\TextToSpeechInterface;
use App\Services\AI\MockScriptGenerator;
use App\Services\AI\MockTextToSpeechProvider;
use App\Services\Rendering\Contracts\RenderProviderInterface;
use App\Services\Rendering\FfmpegRenderProvider;
use App\Services\Rendering\MockRenderProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ScriptGeneratorInterface::class, function () {
            return match (config('video_pipeline.providers.script')) {
                'mock' => new MockScriptGenerator,
                default => new MockScriptGenerator,
            };
        });

        $this->app->bind(TextToSpeechInterface::class, function () {
            return match (config('video_pipeline.providers.tts')) {
                'mock' => new MockTextToSpeechProvider,
                default => new MockTextToSpeechProvider,
            };
        });

        $this->app->bind(RenderProviderInterface::class, function () {
            return match (config('video_pipeline.providers.render')) {
                'ffmpeg' => new FfmpegRenderProvider,
                'mock' => new MockRenderProvider,
                default => new MockRenderProvider,
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin', fn ($user): bool => (bool) $user->is_admin);

        Event::listen(VideoProjectCompleted::class, SendVideoProjectCompletedNotification::class);

        RateLimiter::for('api', function (Request $request): Limit {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
