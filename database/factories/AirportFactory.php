<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Airport;
use App\Models\City;
use Faker\Generator as Faker;

$factory->define(Airport::class, function (Faker $faker) {
    return [
        'name' => $faker->name . ' Airport',
        'city_ID' => City::all()->random()->id,
    ];
});
