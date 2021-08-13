<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booked_seat extends Model
{
    protected $table = "booked_seat";

    protected $fillable = [
        'flight_ID',
        'seat_class_ID',
        'booked_seat',
    ];
}
