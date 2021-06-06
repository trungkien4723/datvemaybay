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
}
