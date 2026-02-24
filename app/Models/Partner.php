<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'logo_path',
        'type',
        'link',
        'sort_order',
    ];
}
