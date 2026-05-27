<?php

namespace App\DTOs;

final readonly class GeneratedAudio
{
    public function __construct(
        public string $disk,
        public string $path,
        public float $durationSeconds,
        public string $mimeType,
    ) {
    }
}
