<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $table = "airline";

    protected $fillable = [
        'name',
        'short_name',
        'logo',
    ];

    public function aircrafts()
    {
        return $this->belongsToMany("App\Models\Aircraft");
    }

    public function search($query)
    {
        return $this->where('name', 'like', '%'.$query.'%')->latest('id')->paginate(10);
    }
}
