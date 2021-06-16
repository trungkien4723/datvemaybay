<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "passenger";

    protected $fillable = [
        'booked_time',
        'flight_ID',
        'adult',
        'children',
        'infant',
        'seat_class_ID',
        'status',
    ];

    public function flight()
    {
        return $this->hasMany("App\Models\Booking", "id", "Flight_ID");
    }

    public function seatClass()
    {
        return $this->hasOne("App\Models\Seat_class", "id", "seat_class_ID");
    }

    public function passenger()
    {
        return $this->hasOne("App\Models\Passenger", "id", "passenger_ID");
    }
}
