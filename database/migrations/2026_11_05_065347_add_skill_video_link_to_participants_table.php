<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('participants', 'skill_video_link')) {
            Schema::table('participants', function (Blueprint $table) {
                $table->string('skill_video_link')->nullable()->after('youtube_link');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('participants', 'skill_video_link')) {
            Schema::table('participants', function (Blueprint $table) {
                $table->dropColumn('skill_video_link');
            });
        }
    }
};