<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    protected $table = "capacity";

    protected $fillable = [
        'aircraft_ID',
        'seat_class_ID',       
        'capacity',
    ];
}
