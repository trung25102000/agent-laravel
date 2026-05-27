<?php

namespace App\Services\Rendering\Contracts;

use App\DTOs\RenderedVideo;
use App\Models\VideoProject;

interface RenderProviderInterface
{
    public function render(VideoProject $videoProject): RenderedVideo;
}
