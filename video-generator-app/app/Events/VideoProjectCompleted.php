<?php

namespace App\Events;

use App\Models\VideoProject;

class VideoProjectCompleted
{
    public function __construct(
        public readonly VideoProject $videoProject,
    ) {
    }
}
