<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class flightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testFlight1 = App\Models\Flight::create([
            'aircraft_ID' => 1,
            'start_airport_ID' => 1,
            'start_time' => Carbon::parse('2021-09-12'),
            'arrive_airport_ID' => 2,
            'arrive_time' => Carbon::parse('2021-09-12'),
            'price' => 500000,
        ]);

        $testFlight2 = App\Models\Flight::create([
            'aircraft_ID' => 2,
            'start_airport_ID' => 2,
            'start_time' => Carbon::parse('2021-09-30'),
            'arrive_airport_ID' => 1,
            'arrive_time' => Carbon::parse('2021-09-30'),
            'price' => 500000,
        ]);
        factory(\App\Models\Flight::class,100)->create();
    }
}
