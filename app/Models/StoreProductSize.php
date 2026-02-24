<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProductSize extends Model
{
    protected $table = 'store_product_sizes';

    protected $fillable = ['product_id', 'size_ar', 'size_en'];

    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'product_id');
    }
}
