<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'ID_number' => $faker->numerify('############'),
        'gender' => $faker->numberBetween(0,1),
        'birthday' => '1991/1/1',
        'address' => 'test address',
        'phone' => $faker->numerify('03########'),
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'),
        'remember_token' => Str::random(10),
    ];
});
