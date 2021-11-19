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
        $startTime = Carbon::now()->addDay(30);
        $arriveTime = Carbon::parse($startTime)->addHour(2);
        $startTime2 = Carbon::parse($startTime)->addDay(2);
        $arriveTime2 = Carbon::parse($startTime2)->addHour(2);
        $testFlight1 = App\Models\Flight::create([
            //'flight_code' => 'TEST000001',
            'aircraft_ID' => 1,
            'start_airport_ID' => 1,
            'start_time' => $startTime,
            'arrive_airport_ID' => 2,
            'arrive_time' => $arriveTime,
            'price' => 500000,
        ]);

        $testFlight2 = App\Models\Flight::create([
            //'flight_code' => 'TEST000002',
            'aircraft_ID' => 2,
            'start_airport_ID' => 2,
            'start_time' => $startTime2,
            'arrive_airport_ID' => 1,
            'arrive_time' => $arriveTime2,
            'price' => 500000,
        ]);

        $testFlight3 = App\Models\Flight::create([
            //'flight_code' => 'TEST000001',
            'aircraft_ID' => 3,
            'start_airport_ID' => 1,
            'start_time' => $startTime,
            'arrive_airport_ID' => 2,
            'arrive_time' => $arriveTime,
            'price' => 500000,
        ]);

        $testFlight4 = App\Models\Flight::create([
            //'flight_code' => 'TEST000002',
            'aircraft_ID' => 4,
            'start_airport_ID' => 2,
            'start_time' => $startTime2,
            'arrive_airport_ID' => 1,
            'arrive_time' => $arriveTime2,
            'price' => 500000,
        ]);
        factory(\App\Models\Flight::class,100)->create();
    }
}
