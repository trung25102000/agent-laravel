<?php

use App\Enums\VideoAssetTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_assets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('video_project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('video_scene_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default(VideoAssetTypeEnum::Image->value);
            $table->string('disk');
            $table->string('path');
            $table->string('source')->default('mock');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['video_project_id', 'type']);
            $table->index(['video_scene_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_assets');
    }
};
