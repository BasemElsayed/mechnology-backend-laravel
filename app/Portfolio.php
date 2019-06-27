<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    //
    protected $fillable = [
        'maintenancePlace', 'maintenanceScope', 'maintenanceDuration', 'maintenanceDescription', 'imageURL',
        'maintenancePlaceArabic', 'maintenanceScopeArabic', 'maintenanceDurationArabic', 'maintenanceDescriptionArabic',
    ];
}
