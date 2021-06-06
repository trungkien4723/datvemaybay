<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";

    protected $fillable = [
        'name',
        'sector_ID',
    ];

    public function sector()
    {
        return $this->hasOne("App\Models\Sector", "id", "sector_ID");
    }

    public function airports()
    {
        return $this->belongsToMany("App\Models\Airport");
    }
}
