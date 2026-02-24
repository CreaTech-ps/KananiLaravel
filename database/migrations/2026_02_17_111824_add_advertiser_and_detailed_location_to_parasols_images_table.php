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
        Schema::table('parasols_images', function (Blueprint $table) {
            $table->string('advertiser_name_ar')->nullable()->after('status');
            $table->string('advertiser_name_en')->nullable()->after('advertiser_name_ar');
            $table->string('advertiser_logo_path')->nullable()->after('advertiser_name_en');
            $table->text('detailed_location_ar')->nullable()->after('location_en');
            $table->text('detailed_location_en')->nullable()->after('detailed_location_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parasols_images', function (Blueprint $table) {
            $table->dropColumn([
                'advertiser_name_ar',
                'advertiser_name_en',
                'advertiser_logo_path',
                'detailed_location_ar',
                'detailed_location_en',
            ]);
        });
    }
};
