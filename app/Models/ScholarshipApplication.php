<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScholarshipApplication extends Model
{
    protected $fillable = [
        'scholarship_id',
        'applicant_name',
        'applicant_id_number',
        'file_path',
        'extra_attachments',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'extra_attachments' => 'array',
    ];

    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(Scholarship::class);
    }
}
