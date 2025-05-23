<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
   
    public function run(): void
    {
        Coupon::truncate();
        Coupon::factory(20)->create();
    }
}
