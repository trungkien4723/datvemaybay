<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Capacity;
use App\Models\Seat_class;
use Faker\Generator as Faker;

$factory->define(Aircraft::class, function (Faker $faker) {
    return [
        'airline_ID' => Airline::all()->random()->id,
    ];
});

$factory->define(Capacity::class, function (Faker $faker) {
    return[
        'capacity' => $this->faker->numberBetween(0, 300),
    ];
});
