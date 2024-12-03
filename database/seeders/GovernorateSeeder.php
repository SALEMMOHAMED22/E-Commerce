<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            [
                "id" => "1",
                "name" => [
                    'ar' => "القاهرة",
                    'en' => "Cairo"
                ],
                "country_id" => 1
            ],
            [
                "id" => "2",
                "name" => ['ar' => "الجيزة", 'en' => "Giza"],
                "country_id" => 1
            ],
            [
                "id" => "3",
                "name" => ['ar' => "الأسكندرية", 'en' => "Alexandria"],
                "country_id" => 1
            ],
            [
                "id" => "4",
                "name" => ['ar' => "الدقهلية", 'en' => "Dakahlia"],
                "country_id" => 1
            ],
            [
                "id" => "5",
                "name" => [
                    'ar' => "البحر الأحمر",
                    'en' => "Red Sea"
                ],
                "country_id" => 1
            ],
            [
                "id" => "6",
                "name" => [
                    'ar' => "البحيرة",
                    'en' => "Beheira"
                ],
                "country_id" => 1
            ],
            [
                "id" => "7",
                "name" => [
                    'ar' => "الفيوم",
                    'en' => "Fayoum"
                ],
                "country_id" => 1
            ],
            [
                "id" => "8",
                "name" => [
                    'ar' => "الغربية",
                    'en' => "Gharbiya"
                ],
                "country_id" => 1
            ],
            [
                "id" => "9",
                "name" => [
                    'ar' => "الإسماعلية",
                    'en' => "Ismailia"
                ],
                "country_id" => 1
            ],
            [
                "id" => "10",
                "name" => [
                    'ar' => "المنوفية",
                    'en' => "Menofia"
                ],
                "country_id" => 1
            ],
            [
                "id" => "11",
                "name" => [
                    'ar' => "المنيا",
                    'en' => "Minya"
                ],
                "country_id" => 1
            ],
            [
                "id" => "12",
                "name" => [
                    'ar' => "القليوبية",
                    'en' => "Qaliubiya"
                ],
                "country_id" => 1
            ],
            [
                "id" => "13",
                "name" => [
                    'ar' => "الوادي الجديد",
                    'en' => "New Valley"
                ],
                "country_id" => 1
            ],
            [
                "id" => "14",
                "name" => [
                    'ar' => "السويس",
                    'en' => "Suez"
                ],
                "country_id" => 1
            ],
            [
                "id" => "15",
                "name" => [
                    'ar' => "اسوان",
                    'en' => "Aswan"
                ],
                "country_id" => 1
            ],
            [
                "id" => "16",
                "name" => [
                    'ar' => "اسيوط",
                    'en' => "Assiut"
                ],
                "country_id" => 1
            ],
            [
                "id" => "17",
                "name" => [
                    'ar' => "بني سويف",
                    'en' => "Beni Suef"
                ],
                "country_id" => 1
            ],
            [
                "id" => "18",
                "name" => [
                    'ar' => "بورسعيد",
                    'en' => "Port Said"
                ],
                "country_id" => 1
            ],
            [
                "id" => "19",
                "name" => [
                    'ar' => "دمياط",
                    'en' => "Damietta"
                ],
                "country_id" => 1
            ],
            [
                "id" => "20",
                "name" => [
                    'ar' => "الشرقية",
                    'en' => "Sharkia"
                ],
                "country_id" => 1
            ],
            [
                "id" => "21",
                "name" => [
                    'ar' => "جنوب سيناء",
                    'en' => "South Sinai"
                ],
                "country_id" => 1
            ],
            [
                "id" => "22",
                "name" => [
                    'ar' => "كفر الشيخ",
                    'en' => "Kafr Al sheikh"
                ],
                "country_id" => 1
            ],
            [
                "id" => "23",
                "name" => [
                    'ar' => "مطروح",
                    'en' => "Matrouh"
                ],
                "country_id" => 1
            ],
            [
                "id" => "24",
                "name" => [
                    'ar' => "الأقصر",
                    'en' => "Luxor"
                ],
                "country_id" => 1
            ],
            [
                "id" => "25",
                "name" => [
                    'ar' => "قنا",
                    'en' => "Qena"
                ],
                "country_id" => 1
            ],
            [
                "id" => "26",
                "name" => [
                    'ar' => "شمال سيناء",
                    'en' => "North Sinai"
                ],
                "country_id" => 1
            ],
            [
                "id" => "27",
                "name" => ['ar' => "سوهاج", 'en' => "Sohag"],
                "country_id" => 1
            ],
           
        ];

        foreach($governorates as $governorate){

            Governorate::create($governorate);
        }
    }
}
