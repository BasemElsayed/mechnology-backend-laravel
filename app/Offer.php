<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = [
        'duration', 'price', 'feature1', 'feature2', 'feature3',
    ];
}
