<?php

use Illuminate\Database\Seeder;

class airlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Airline::class,5)->create();
    }
}
