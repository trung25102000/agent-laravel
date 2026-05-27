<?php

use App\Enums\VideoSceneStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_scenes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('video_project_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order');
            $table->text('text');
            $table->decimal('duration_seconds', 6, 2);
            $table->text('visual_prompt');
            $table->string('status')->default(VideoSceneStatusEnum::Pending->value);
            $table->timestamps();

            $table->unique(['video_project_id', 'sort_order']);
            $table->index(['video_project_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_scenes');
    }
};
