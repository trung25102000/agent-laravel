<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->string('subtitle_disk')->nullable()->after('audio_duration_seconds');
            $table->string('subtitle_path')->nullable()->after('subtitle_disk');
        });
    }

    public function down(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->dropColumn(['subtitle_disk', 'subtitle_path']);
        });
    }
};
