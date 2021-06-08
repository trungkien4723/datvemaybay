<?php

use Illuminate\Database\Seeder;

class citySectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectors = [
            ['name' => 'Việt Nam'],
        ];

        $cities = [
            ['name' => 'Hà Nội', 'sector_ID' => '1'],
            ['name' => 'Hải Phòng', 'sector_ID' => '1'],
            ['name' => 'Điện Biên', 'sector_ID' => '1'],
            ['name' => 'Thanh Hóa', 'sector_ID' => '1'],
            ['name' => 'Nghệ An', 'sector_ID' => '1'],
            ['name' => 'Quảng Bình', 'sector_ID' => '1'],
            ['name' => 'Thừa Thiên - Huế', 'sector_ID' => '1'],
            ['name' => 'Đà Nẵng', 'sector_ID' => '1'],
            ['name' => 'Quảng Nam', 'sector_ID' => '1'],
            ['name' => 'Bình Định', 'sector_ID' => '1'],
            ['name' => 'Phú Yên', 'sector_ID' => '1'],
            ['name' => 'Khánh Hòa', 'sector_ID' => '1'],
            ['name' => 'Đắk Lắk', 'sector_ID' => '1'],
            ['name' => 'Lâm Đồng', 'sector_ID' => '1'],
            ['name' => 'Gia Lai', 'sector_ID' => '1'],
            ['name' => 'TP HCM', 'sector_ID' => '1'],
            ['name' => 'Cà Mau', 'sector_ID' => '1'],
            ['name' => 'Bà Rịa-Vũng Tàu', 'sector_ID' => '1'],
            ['name' => 'Cần Thơ', 'sector_ID' => '1'],
            ['name' => 'Kiên Giang', 'sector_ID' => '1'],
            ['name' => 'Quảng Ninh', 'sector_ID' => '1'],
        ];

        foreach ($sectors as $item) {
            \App\Models\Sector::create($item);
        }

        foreach ($cities as $item) {
            \App\Models\City::create($item);
        }
    }
}
