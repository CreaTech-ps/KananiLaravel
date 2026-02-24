<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeStatistic extends Model
{
    protected $table = 'home_statistics';

    protected $fillable = [
        'value',
        'label_ar',
        'label_en',
        'icon',
        'sort_order',
    ];
}
