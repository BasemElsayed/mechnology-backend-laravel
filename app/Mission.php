<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    //
    protected $fillable = [
        'missionH', 'missionP', 'missionHArabic', 'missionPArabic',
    ];
}