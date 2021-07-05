<?php

use Illuminate\Database\Seeder;
use App\Models\Seat_class;
class aircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Aircraft::class,50)->create()->each(function($aircraft){
            $seatClasses = Seat_class::get();
            foreach($seatClasses as $item)
            {
                factory(App\Models\Capacity::class)->create([
                    'aircraft_ID' => $aircraft,
                    'seat_class_ID' => $item->id,
                ]);
            }

        });
    }
}
