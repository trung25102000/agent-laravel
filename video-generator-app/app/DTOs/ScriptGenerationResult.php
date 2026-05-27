<?php

namespace App\DTOs;

final readonly class ScriptGenerationResult
{
    public function __construct(
        public string $title,
        public string $hook,
        public string $body,
        public string $callToAction,
    ) {}

    public function toScriptText(): string
    {
        return implode("\n\n", [
            "Title: {$this->title}",
            "Hook: {$this->hook}",
            $this->body,
            "CTA: {$this->callToAction}",
        ]);
    }
}
