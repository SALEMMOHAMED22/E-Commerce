<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'id' => 1,
                'phone_code' =>'20',
                'name' => ['en'=>'Egypt' , 'ar'=>'مصر'],
            ],
            [
                'id' => 2,
                'phone_code' =>'996',
                'name' => ['en'=>'Saudi' , 'ar'=>'السعودية'],
            ]
        ];

    foreach($countries as $country){
        Country::create($country);
    }
    }
}
