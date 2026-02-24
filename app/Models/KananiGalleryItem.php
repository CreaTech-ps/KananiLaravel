<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KananiGalleryItem extends Model
{
    protected $fillable = [
        'image_path',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'sort_order',
    ];
}
