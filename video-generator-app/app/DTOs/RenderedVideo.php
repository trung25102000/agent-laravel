<?php

namespace App\DTOs;

final readonly class RenderedVideo
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public string $disk,
        public string $path,
        public string $mimeType,
        public ?float $durationSeconds = null,
        public ?int $sizeBytes = null,
        public array $metadata = [],
    ) {}
}
