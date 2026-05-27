<?php

namespace App\Enums;

enum VideoSceneStatusEnum: string
{
    case Pending = 'pending';
    case Ready = 'ready';
    case Failed = 'failed';
}
