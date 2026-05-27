<?php

use App\Enums\VideoProjectStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_projects', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('keyword');
            $table->text('content_brief')->nullable();
            $table->string('tone')->default('neutral');
            $table->unsignedSmallInteger('duration_seconds')->default(30);
            $table->string('platform')->default('tiktok');
            $table->string('language', 10)->default('vi');
            $table->string('status')->default(VideoProjectStatusEnum::Draft->value);
            $table->unsignedTinyInteger('progress_percent')->default(0);
            $table->text('error_message')->nullable();
            $table->longText('script_content')->nullable();
            $table->string('rendered_video_path')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_projects');
    }
};
