<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('file_path')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, approved, closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_requests');
    }
};
