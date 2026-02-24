<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';

    protected $fillable = [
        'name_ar',
        'name_en',
        'title_ar',
        'title_en',
        'photo_path',
        'type',
        'sort_order',
    ];
}
