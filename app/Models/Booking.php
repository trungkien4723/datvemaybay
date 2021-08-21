<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "booking";

    protected $fillable = [
        'booking_key',
        'booked_time',       
        'flight_ID',
        'passenger_ID',
        'adult',
        'children',
        'infant',
        'seat_class_ID',
        'total_price',
        'status',
    ];

    public function flight()
    {
        return $this->hasOne("App\Models\Booking", "id", "Flight_ID");
    }

    public function seatClass()
    {
        return $this->hasOne("App\Models\Seat_class", "id", "seat_class_ID");
    }

    public function passenger()
    {
        return $this->hasOne("App\Models\Passenger", "id", "passenger_ID");
    }

    public function search($query)
    {
        return $this->where('booking_key', 'like', '%'.$query.'%')
        ->orWhereHas('flight', function($q) use ($query){
            $q->where('id', '=', $query);
        })
        ->orWhereHas('seatClass', function($q) use ($query){
            $q->where('name', 'like', '%'.$query.'%');
        })->orWhereHas('passenger', function($q) use ($query){
            $q->where('first_name', 'like', '%'.$query.'%')
            ->orWhere('last_name', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orWhere('ID_number', 'like', '%'.$query.'%')
            ->orWhere('phone', 'like', '%'.$query.'%');
        })->latest('id')->paginate(10);
    }
}
