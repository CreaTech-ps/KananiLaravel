<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParasolsRegion extends Model
{
    protected $table = 'parasols_regions';

    protected $fillable = [
        'name_ar',
        'name_en',
        'sort_order',
    ];

    public function images()
    {
        return $this->hasMany(ParasolsImage::class, 'region_id')->orderBy('sort_order');
    }
}
