<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpowermentRequest extends Model
{
    protected $table = 'empowerment_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
