<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerDepartment extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(VolunteerApplication::class);
    }

    public static function getActive()
    {
        return static::where('is_active', true)->orderBy('order')->get();
    }
}
