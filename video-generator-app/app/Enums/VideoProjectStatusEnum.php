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

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Queued => 'Queued',
            self::Scripting => 'Writing script',
            self::Rendering => 'Rendering',
            self::Completed => 'Completed',
            self::Failed => 'Failed',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Draft => 'bg-zinc-100 text-zinc-700 ring-zinc-200',
            self::Queued => 'bg-sky-50 text-sky-700 ring-sky-200',
            self::Scripting => 'bg-amber-50 text-amber-800 ring-amber-200',
            self::Rendering => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
            self::Completed => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            self::Failed => 'bg-rose-50 text-rose-700 ring-rose-200',
        };
    }

    public function isFinished(): bool
    {
        return in_array($this, [self::Completed, self::Failed], true);
    }
}
