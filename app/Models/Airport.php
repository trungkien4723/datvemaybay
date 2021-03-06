<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = 'airport';

    protected $fillable = [
        'name',
        'city_ID',
    ];

    public function city()
    {
        return $this->hasOne("App\Models\City", "id", "city_ID");
    }

    public function flights()
    {
        return $this->belongsToMany("App\Models\Flight");
    }

    public function search($query)
    {
        return $this->whereHas('city', function($q) use ($query){
            $q->where('name','like','%'.$query.'%');
        })->orWhere(function($q) use ($query){
            $q->where('name', 'like', '%'.$query.'%');
        })->latest('id')->paginate(10);
    }
}
