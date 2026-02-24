<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kanani_settings', function (Blueprint $table) {
            $table->text('discover_more_text_ar')->nullable()->after('intro_text_en');
            $table->text('discover_more_text_en')->nullable()->after('discover_more_text_ar');
            $table->string('hero_video_url')->nullable()->after('hero_media_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kanani_settings', function (Blueprint $table) {
            $table->dropColumn(['discover_more_text_ar', 'discover_more_text_en', 'hero_video_url']);
        });
    }
};
