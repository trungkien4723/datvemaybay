<?php

use Illuminate\Database\Seeder;

class flightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Flight::class,100)->create();
    }
}
