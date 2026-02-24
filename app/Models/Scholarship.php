<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scholarship extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'slug_ar',
        'slug_en',
        'summary_ar',
        'summary_en',
        'image_path',
        'application_start_date',
        'application_end_date',
        'details_ar',
        'details_en',
        'conditions_ar',
        'conditions_en',
        'required_documents_ar',
        'required_documents_en',
        'application_form_pdf_path',
        'coverage_percentage',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'application_start_date' => 'date',
        'application_end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(ScholarshipApplication::class);
    }
}
