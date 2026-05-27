<?php

namespace App\Listeners;

use App\Events\VideoProjectCompleted;
use App\Notifications\VideoProjectRenderedNotification;

class SendVideoProjectCompletedNotification
{
    public function handle(VideoProjectCompleted $event): void
    {
        $event->videoProject->user->notify(
            new VideoProjectRenderedNotification($event->videoProject)
        );
    }
}
