<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
     public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'image','status','descr'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'tbl_slider';
}
