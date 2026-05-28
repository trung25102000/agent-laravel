<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemoProject extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function sourceCodeProduct(): BelongsTo
    {
        return $this->belongsTo(SourceCodeProduct::class);
    }

    public function websiteTemplate(): BelongsTo
    {
        return $this->belongsTo(WebsiteTemplate::class);
    }
}
