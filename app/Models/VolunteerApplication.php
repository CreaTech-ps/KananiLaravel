<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'volunteer_department_id',
        'cv_path',
        'status',
        'admin_notes',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(VolunteerDepartment::class, 'volunteer_department_id');
    }
}
