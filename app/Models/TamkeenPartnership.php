<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamkeenPartnership extends Model
{
    protected $table = 'tamkeen_partnerships';

    protected $fillable = [
        'supporter_name_ar',
        'supporter_name_en',
        'sector',
        'start_date',
        'beneficiaries_count',
        'logo_path',
        'link',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
    ];
}
