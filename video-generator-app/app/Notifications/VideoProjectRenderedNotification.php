<?php

namespace App\Notifications;

use App\Models\VideoProject;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class VideoProjectRenderedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly VideoProject $videoProject,
    ) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'video_project_id' => $this->videoProject->id,
            'keyword' => $this->videoProject->keyword,
            'status' => $this->videoProject->status->value,
            'message' => 'Your video is ready to preview and download.',
        ]);
    }
}
