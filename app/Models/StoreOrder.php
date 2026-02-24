<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    protected $table = 'store_orders';

    protected $fillable = [
        'order_number',
        'buyer_name',
        'phone',
        'address',
        'country',
        'delivery_date',
        'receiver_name',
        'receiver_phone',
        'subtotal',
        'discount_total',
        'shipping_cost',
        'total',
        'items_data',
        'status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
        'delivery_date' => 'date',
        'items_data' => 'array',
    ];

    public function getItemsAttribute(): array
    {
        return $this->items_data ?? [];
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد التجهيز',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => $this->status,
        };
    }
}
