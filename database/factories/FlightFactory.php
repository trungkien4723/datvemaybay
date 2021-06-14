<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Flight;
use App\Models\Aircraft;
use App\Models\Airport;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeThisYear('+1 month');
    $arriveDate   = strtotime('+1 Hour', $startingDate->getTimestamp());
    return [
        'aircraft_ID' => Aircraft::all()->random()->id,
        'start_airport_ID' => Airport::all()->random()->id,
        'start_time' => $startingDate,
        'arrive_airport_ID' => Airport::all()->random()->id,
        'arrive_time' => $startingDate,
        'price' => '500000',
    ];
});
