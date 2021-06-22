<?php

use Illuminate\Database\Seeder;

class airportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testAirport1 = App\Models\Airport::create([
            'name' => 'Test airpost 1',
            'city_ID' => 1,
        ]);
        $testAirport2 = App\Models\Airport::create([
            'name' => 'Test airpost 2',
            'city_ID' => 2,
        ]);
        factory(\App\Models\Airport::class,10)->create();
    }
}
