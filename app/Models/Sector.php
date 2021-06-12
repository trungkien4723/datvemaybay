<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = "sector";

    protected $fillable = [
        'name',
    ];

    public function cities()
    {
        return $this->belongsToMany("App\Models\City");
    }
}
