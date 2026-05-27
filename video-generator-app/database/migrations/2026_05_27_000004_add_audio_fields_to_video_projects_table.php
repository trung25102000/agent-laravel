<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->string('audio_disk')->nullable()->after('script_content');
            $table->string('audio_path')->nullable()->after('audio_disk');
            $table->decimal('audio_duration_seconds', 8, 2)->nullable()->after('audio_path');
        });
    }

    public function down(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->dropColumn(['audio_disk', 'audio_path', 'audio_duration_seconds']);
        });
    }
};
