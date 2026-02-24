<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'type',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'sort_order',
    ];

    public const TYPES = ['vision', 'mission', 'goals', 'values'];

    public static function getForAbout(): \Illuminate\Support\Collection
    {
        $sections = static::orderBy('sort_order')->get();
        $byType = $sections->keyBy('type');
        foreach (self::TYPES as $type) {
            if (!$byType->has($type)) {
                $newSection = static::create([
                    'type' => $type,
                    'title_ar' => $type === 'vision' ? 'الرؤية' : ($type === 'mission' ? 'الرسالة' : ($type === 'goals' ? 'الأهداف' : 'القيم')),
                    'title_en' => null,
                    'content_ar' => '',
                    'content_en' => null,
                    'sort_order' => array_search($type, self::TYPES),
                ]);
                $byType->put($type, $newSection);
            }
        }
        return collect(self::TYPES)->map(fn ($t) => $byType->get($t));
    }
}
