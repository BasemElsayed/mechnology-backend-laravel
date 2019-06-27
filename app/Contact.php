<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'addressEnglish', 'addressArabic', 'email', 'phone', 'mobile', 'from', 'to', 'holidaysEnglish', 'holidaysArabic', 'latitude', 'langitude',
    ];
}