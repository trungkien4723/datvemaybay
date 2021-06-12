<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = "passenger";

    protected $fillable = [
        'booking_ID',
        'first_name',
        'last_name',
        'gender',
    ];
}
