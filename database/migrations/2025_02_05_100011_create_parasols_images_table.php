<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parasols_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('parasols_regions')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parasols_images');
    }
};
