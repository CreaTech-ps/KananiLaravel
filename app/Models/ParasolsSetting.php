<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParasolsSetting extends Model
{
    protected $table = 'parasols_settings';

    protected $fillable = [
        'description_ar',
        'description_en',
        'hero_title_ar',
        'hero_title_en',
        'hero_subtitle_ar',
        'hero_subtitle_en',
        'cta_primary_text_ar',
        'cta_primary_url',
        'cta_secondary_text_ar',
        'cta_secondary_url',
        'section_title_ar',
        'section_title_en',
        'stat1_value',
        'stat1_label_ar',
        'stat2_value',
        'stat2_label_ar',
        'stat3_value',
        'stat3_label_ar',
        'stat4_value',
        'stat4_label_ar',
        'whatsapp_url',
    ];

    public static function get(): self
    {
        $row = static::first();
        if ($row) {
            return $row;
        }
        return static::create([]);
    }
}
