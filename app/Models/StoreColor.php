<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreColor extends Model
{
    protected $table = 'store_colors';

    protected $fillable = ['name_ar', 'name_en', 'hex_code'];

    public function products()
    {
        return $this->belongsToMany(StoreProduct::class, 'store_product_colors', 'color_id', 'product_id');
    }
}
