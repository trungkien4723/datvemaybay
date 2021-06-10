<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_detail extends Model
{
    protected $table = "contact_detail";

    protected $fillable = [
        'booking_ID',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
}
