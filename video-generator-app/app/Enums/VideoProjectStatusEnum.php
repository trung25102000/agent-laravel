<?php

namespace App\Enums;

enum VideoProjectStatusEnum: string
{
    case Draft = 'draft';
    case Queued = 'queued';
    case Scripting = 'scripting';
    case Rendering = 'rendering';
    case Completed = 'completed';
    case Failed = 'failed';
}
