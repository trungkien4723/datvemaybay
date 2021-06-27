<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Aircraft;
use App\Models\Airline;
use Faker\Generator as Faker;

$factory->define(Aircraft::class, function (Faker $faker) {
    return [
        'airline_ID' => Airline::all()->random()->id,
    ];
});
