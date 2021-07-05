<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    protected $table = "aircraft";

    protected $fillable = [
        'airline_ID',
    ];

    public function airline()
    {
        return $this->hasOne("App\Models\Airline", "id", "airline_ID");
    }

    public function flights()
    {
        return $this->belongsToMany("App\Models\Flight");
    }

    public function capacity()
    {
        return $this->hasOne("App\Models\Capacity", "aircraft_ID", "id");
    }
}
