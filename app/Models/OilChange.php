<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilChange extends Model
{
    protected $fillable = [
        'current_odometer',
        'prev_oil_change_date',
        'prev_odometer',
        'is_due',
    ];

    protected $casts = [
        'is_due' => 'boolean',
    ];
}
