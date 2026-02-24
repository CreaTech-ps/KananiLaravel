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
        Schema::table('about_page', function (Blueprint $table) {
            $table->text('founder_full_message_ar')->nullable()->after('founder_message_video_url');
            $table->text('founder_full_message_en')->nullable()->after('founder_full_message_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_page', function (Blueprint $table) {
            $table->dropColumn(['founder_full_message_ar', 'founder_full_message_en']);
        });
    }
};
