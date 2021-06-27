<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = "passenger";

    protected $fillable = [
        'booking_ID',
        'user_ID',
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
    ];

    public function user()
    {
        return $this->hasOne("App\Models\User", "id", "user_ID");
    }

    public function bookings()
    {
        return $this->belongsToMany("App\Models\Booking");
    }
}
