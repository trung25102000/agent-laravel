<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->string('output_disk')->nullable()->after('rendered_video_path');
            $table->decimal('render_duration_seconds', 8, 2)->nullable()->after('output_disk');
            $table->unsignedBigInteger('render_size_bytes')->nullable()->after('render_duration_seconds');
            $table->json('render_metadata')->nullable()->after('render_size_bytes');
        });
    }

    public function down(): void
    {
        Schema::table('video_projects', function (Blueprint $table): void {
            $table->dropColumn([
                'output_disk',
                'render_duration_seconds',
                'render_size_bytes',
                'render_metadata',
            ]);
        });
    }
};
