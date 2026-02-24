<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kanani_settings', function (Blueprint $table) {
            $table->id();
            $table->string('intro_video_url')->nullable();
            $table->text('intro_text_ar')->nullable();
            $table->text('intro_text_en')->nullable();
            $table->string('store_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kanani_settings');
    }
};
