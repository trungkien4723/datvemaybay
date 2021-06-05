<?php

use Illuminate\Database\Seeder;

class seatClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seatClass = \App\Models\Seat_class::create([
            'name' => 'Hạng nhất (First Class)',
        ]);

        $seatClass = \App\Models\Seat_class::create([
            'name' => 'Ghế hạng Thương gia ( Business Class)',
        ]);

        $seatClass = \App\Models\Seat_class::create([
            'name' => 'Ghế hạng Phổ thông (Economy Class)',
        ]);

        $seatClass = \App\Models\Seat_class::create([
            'name' => 'Hạng phổ thông đặc biệt (Deluxe Economy Class)',
        ]);
    }
}
