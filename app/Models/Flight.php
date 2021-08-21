<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flight';

    protected $fillable = [
        'aircraft_ID',
        'start_airport_ID',
        'start_time',
        'arrive_airport_ID',
        'arrive_time',
        'price',
    ];

    public function startAirport()
    {
        return $this->hasOne("App\Models\Airport", "id", "start_airport_ID");
    }

    public function arriveAirport()
    {
        return $this->hasOne("App\Models\Airport", "id", "arrive_airport_ID");
    }

    public function aircraft()
    {
        return $this->hasOne("App\Models\Aircraft", "id", "aircraft_ID");
    }

    public function search($query)
    {
        return $this->whereHas('startAirPort', function($q) use ($query){
            $q->where('name','like','%'.$query.'%')
            ->orWhereHas('city', function($q) use ($query){
                $q->where('name', 'like', '%'.$query.'%');
            });
        })
        ->orWhereHas('arriveAirPort', function($q) use ($query){
            $q->where('name','like','%'.$query.'%')
            ->orWhereHas('city', function($q) use ($query){
                $q->where('name', 'like', '%'.$query.'%');
            });
        })
        ->orWhereHas('aircraft', function($q) use ($query){
            $q->where('id','=',$query);
        })
        ->orWhereDate('start_time', '=', date("Y-m-d", strtotime($query)))
        ->latest('id')->paginate(10);
    }
}
