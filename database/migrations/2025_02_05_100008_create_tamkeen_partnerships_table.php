<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tamkeen_partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('supporter_name_ar');
            $table->string('supporter_name_en')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('beneficiaries_count')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('link')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tamkeen_partnerships');
    }
};
