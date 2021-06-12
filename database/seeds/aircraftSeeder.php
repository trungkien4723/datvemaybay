<?php

use Illuminate\Database\Seeder;

class aircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Aircraft::class,50)->create();
    }
}
