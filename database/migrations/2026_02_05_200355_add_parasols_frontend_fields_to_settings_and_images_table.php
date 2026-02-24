<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parasols_settings', function (Blueprint $table) {
            $table->string('hero_title_ar')->nullable()->after('description_en');
            $table->string('hero_title_en')->nullable()->after('hero_title_ar');
            $table->text('hero_subtitle_ar')->nullable()->after('hero_title_en');
            $table->text('hero_subtitle_en')->nullable()->after('hero_subtitle_ar');
            $table->string('cta_primary_text_ar')->nullable()->after('hero_subtitle_en');
            $table->string('cta_primary_url')->nullable()->after('cta_primary_text_ar');
            $table->string('cta_secondary_text_ar')->nullable()->after('cta_primary_url');
            $table->string('cta_secondary_url')->nullable()->after('cta_secondary_text_ar');
            $table->string('section_title_ar')->nullable()->after('cta_secondary_url');
            $table->string('section_title_en')->nullable()->after('section_title_ar');
            $table->string('stat1_value')->nullable()->after('section_title_en');
            $table->string('stat1_label_ar')->nullable()->after('stat1_value');
            $table->string('stat2_value')->nullable()->after('stat1_label_ar');
            $table->string('stat2_label_ar')->nullable()->after('stat2_value');
            $table->string('stat3_value')->nullable()->after('stat2_label_ar');
            $table->string('stat3_label_ar')->nullable()->after('stat3_value');
            $table->string('stat4_value')->nullable()->after('stat3_label_ar');
            $table->string('stat4_label_ar')->nullable()->after('stat4_value');
        });

        Schema::table('parasols_images', function (Blueprint $table) {
            $table->string('location_ar')->nullable()->after('title_en');
            $table->string('location_en')->nullable()->after('location_ar');
            $table->string('price')->nullable()->after('location_en');
            $table->string('status')->nullable()->after('price'); // available | ending_soon
        });
    }

    public function down(): void
    {
        Schema::table('parasols_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title_ar', 'hero_title_en', 'hero_subtitle_ar', 'hero_subtitle_en',
                'cta_primary_text_ar', 'cta_primary_url', 'cta_secondary_text_ar', 'cta_secondary_url',
                'section_title_ar', 'section_title_en',
                'stat1_value', 'stat1_label_ar', 'stat2_value', 'stat2_label_ar',
                'stat3_value', 'stat3_label_ar', 'stat4_value', 'stat4_label_ar',
            ]);
        });
        Schema::table('parasols_images', function (Blueprint $table) {
            $table->dropColumn(['location_ar', 'location_en', 'price', 'status']);
        });
    }
};
