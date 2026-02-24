<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kanani_settings', function (Blueprint $table) {
            $table->string('hero_badge_ar')->nullable()->after('store_url');
            $table->string('hero_title_ar')->nullable()->after('hero_badge_ar');
            $table->string('hero_title_en')->nullable()->after('hero_title_ar');
            $table->text('hero_subtitle_ar')->nullable()->after('hero_title_en');
            $table->text('hero_subtitle_en')->nullable()->after('hero_subtitle_ar');
            $table->string('hero_point1_ar')->nullable()->after('hero_subtitle_en');
            $table->string('hero_point2_ar')->nullable()->after('hero_point1_ar');
            $table->string('hero_point3_ar')->nullable()->after('hero_point2_ar');
            $table->string('hero_media_path')->nullable()->after('hero_point3_ar');
            $table->string('stat1_value')->nullable()->after('hero_media_path');
            $table->string('stat1_label_ar')->nullable()->after('stat1_value');
            $table->string('stat2_value')->nullable()->after('stat1_label_ar');
            $table->string('stat2_label_ar')->nullable()->after('stat2_value');
            $table->string('stat3_value')->nullable()->after('stat2_label_ar');
            $table->string('stat3_label_ar')->nullable()->after('stat3_value');
            $table->string('gallery_section_title_ar')->nullable()->after('stat3_label_ar');
            $table->string('gallery_section_subtitle_ar')->nullable()->after('gallery_section_title_ar');
            $table->string('gallery_link_text_ar')->nullable()->after('gallery_section_subtitle_ar');
            $table->string('gallery_link_url')->nullable()->after('gallery_link_text_ar');
            $table->string('cta_title_ar')->nullable()->after('gallery_link_url');
            $table->text('cta_subtitle_ar')->nullable()->after('cta_title_ar');
            $table->string('cta_button_text_ar')->nullable()->after('cta_subtitle_ar');
            $table->string('cta_button_url')->nullable()->after('cta_button_text_ar');
        });

        Schema::table('kanani_gallery_items', function (Blueprint $table) {
            $table->string('location_ar')->nullable()->after('title_en');
            $table->string('location_en')->nullable()->after('location_ar');
            $table->string('price')->nullable()->after('location_en');
            $table->string('badge')->nullable()->after('price'); // handcrafted | bestseller | null
        });
    }

    public function down(): void
    {
        Schema::table('kanani_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge_ar', 'hero_title_ar', 'hero_title_en', 'hero_subtitle_ar', 'hero_subtitle_en',
                'hero_point1_ar', 'hero_point2_ar', 'hero_point3_ar', 'hero_media_path',
                'stat1_value', 'stat1_label_ar', 'stat2_value', 'stat2_label_ar', 'stat3_value', 'stat3_label_ar',
                'gallery_section_title_ar', 'gallery_section_subtitle_ar', 'gallery_link_text_ar', 'gallery_link_url',
                'cta_title_ar', 'cta_subtitle_ar', 'cta_button_text_ar', 'cta_button_url',
            ]);
        });
        Schema::table('kanani_gallery_items', function (Blueprint $table) {
            $table->dropColumn(['location_ar', 'location_en', 'price', 'badge']);
        });
    }
};
