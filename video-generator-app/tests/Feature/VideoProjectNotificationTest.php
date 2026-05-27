<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VideoProject;
use App\Notifications\VideoProjectRenderedNotification;
use App\Services\VideoRenderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VideoProjectNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_notified_when_video_project_render_completes(): void
    {
        Notification::fake();
        Storage::fake('local');

        $user = User::factory()->create();
        $videoProject = VideoProject::factory()->create([
            'user_id' => $user->id,
        ]);

        app(VideoRenderService::class)->render($videoProject);

        Notification::assertSentTo(
            $user,
            VideoProjectRenderedNotification::class,
            fn (VideoProjectRenderedNotification $notification): bool => $notification
                ->toDatabase($user)
                ->data['video_project_id'] === $videoProject->id
        );
    }
}
