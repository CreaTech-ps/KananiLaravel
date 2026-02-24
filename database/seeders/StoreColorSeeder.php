<?php

namespace Database\Seeders;

use App\Models\StoreColor;
use Illuminate\Database\Seeder;

class StoreColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name_ar' => 'أحمر', 'name_en' => 'Red', 'hex_code' => '#EF4444'],
            ['name_ar' => 'أزرق', 'name_en' => 'Blue', 'hex_code' => '#3B82F6'],
            ['name_ar' => 'أخضر', 'name_en' => 'Green', 'hex_code' => '#22C55E'],
            ['name_ar' => 'أصفر', 'name_en' => 'Yellow', 'hex_code' => '#EAB308'],
            ['name_ar' => 'أسود', 'name_en' => 'Black', 'hex_code' => '#171717'],
            ['name_ar' => 'أبيض', 'name_en' => 'White', 'hex_code' => '#FFFFFF'],
            ['name_ar' => 'بني', 'name_en' => 'Brown', 'hex_code' => '#92400E'],
            ['name_ar' => 'بنفسجي', 'name_en' => 'Purple', 'hex_code' => '#9333EA'],
            ['name_ar' => 'وردي', 'name_en' => 'Pink', 'hex_code' => '#EC4899'],
            ['name_ar' => 'برتقالي', 'name_en' => 'Orange', 'hex_code' => '#F97316'],
            ['name_ar' => 'رمادي', 'name_en' => 'Gray', 'hex_code' => '#6B7280'],
            ['name_ar' => 'ذهبي', 'name_en' => 'Gold', 'hex_code' => '#D4AF37'],
            ['name_ar' => 'فضي', 'name_en' => 'Silver', 'hex_code' => '#9CA3AF'],
        ];

        foreach ($colors as $c) {
            StoreColor::firstOrCreate(
                ['name_ar' => $c['name_ar']],
                $c
            );
        }
    }
}
