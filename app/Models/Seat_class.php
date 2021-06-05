<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat_class extends Model
{
    protected $table = "seat_class";

    protected $fillable = [
        'name',
    ];
}
