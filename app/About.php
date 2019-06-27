<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    //
    protected $fillable = [
        'aboutUs', 'vision', 'job', 'worker', 'client', 'aboutUsArabic', 'visionArabic',
    ];
}
