<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParasolsImage extends Model
{
    protected $table = 'parasols_images';

    protected $fillable = [
        'region_id',
        'image_path',
        'title_ar',
        'title_en',
        'location_ar',
        'location_en',
        'detailed_location_ar',
        'detailed_location_en',
        'price',
        'status',
        'advertiser_name_ar',
        'advertiser_name_en',
        'advertiser_logo_path',
        'sort_order',
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_NEWLY_BOOKED = 'newly_booked';
    public const STATUS_ENDING_SOON = 'ending_soon';

    public function region()
    {
        return $this->belongsTo(ParasolsRegion::class, 'region_id');
    }
}
