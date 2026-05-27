<?php

namespace App\DTOs;

final readonly class RenderedVideo
{
    public function __construct(
        public string $disk,
        public string $path,
        public string $mimeType,
    ) {
    }
}
