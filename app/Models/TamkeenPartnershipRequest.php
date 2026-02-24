<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamkeenPartnershipRequest extends Model
{
    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'message',
        'status',
        'admin_notes',
    ];
}
