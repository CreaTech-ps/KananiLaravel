<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KananiSetting extends Model
{
    protected $table = 'kanani_settings';

    protected $fillable = [
        'intro_video_url',
        'intro_text_ar',
        'intro_text_en',
        'discover_more_text_ar',
        'discover_more_text_en',
        'hero_video_url',
        'store_url',
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
