<?php

namespace App\Enums;

enum VideoAssetTypeEnum: string
{
    case Image = 'image';
    case Video = 'video';
    case Voice = 'voice';
    case Subtitle = 'subtitle';
    case Output = 'output';
}
