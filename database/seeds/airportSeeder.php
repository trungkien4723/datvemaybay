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
        factory(\App\Models\Airport::class,10)->create();
    }
}
