<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => [
                'ar' => 'الشروط و المصطلحات',
                'en' => 'Terms and Condtions',
            ], 
            'content' => [
                'ar' => 'عادةً ما تحتوي الشروط والأحكام على وصف موجز لسياسة الخصوصية الخاصة بك',
                'en' => 'Terms and Condtions typically have a short description of your privacy policy ' ,
            ],
            'slug' => 'Terms-Condtions'
        ]);
        Page::create([
            'title' => [
                'ar' => 'سياسة الخصوصيه',
                'en' => 'Privacy Policy',
            ], 
            'content' => [
                'ar' => 'عادةً ما تحتوي الشروط والأحكام على وصف موجز لسياسة الخصوصية الخاصة بك',
                'en' => 'Terms and Condtions typically have a short description of your privacy policy ' ,
            ],
            'slug' => 'Privacy-Policy'
        ]);


    }
}
