<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $table = 'store_products';

    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'slug_ar',
        'slug_en',
        'description_ar',
        'description_en',
        'price',
        'old_price',
        'discount_percent',
        'image_path',
        'images',
        'stock',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getImagePathsAttribute(): array
    {
        $images = $this->images;
        if (is_array($images) && !empty($images)) {
            return $images;
        }
        return $this->image_path ? [$this->image_path] : [];
    }

    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    public function sizes()
    {
        return $this->hasMany(StoreProductSize::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(StoreColor::class, 'store_product_colors', 'product_id', 'color_id');
    }
}
