<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Flight;
use App\Models\Aircraft;
use App\Models\Airport;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeBetween('now', '+3 months');
    $arriveDate   = $faker->dateTimeBetween($startingDate, $startingDate->format('Y-m-d H:i:s').'+3 hours');
    return [
        'aircraft_ID' => Aircraft::all()->random()->id,
        'start_airport_ID' => Airport::all()->random()->id,
        'start_time' => $startingDate,
        'arrive_airport_ID' => Airport::all()->random()->id,
        'arrive_time' => $arriveDate,
        'price' => '500000',
    ];
});
