<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use App\Models\ShippingGovernorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            // suadia
            ['name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 'country_id' => 2],
            ['name' => ['en' => 'Makkah', 'ar' => 'مكة المكرمة'], 'country_id' => 2],
            ['name' => ['en' => 'Medina', 'ar' => 'المدينة المنورة'], 'country_id' => 2],
            ['name' => ['en' => 'Eastern Province', 'ar' => 'المنطقة الشرقية'], 'country_id' => 2],
            ['name' => ['en' => 'Asir', 'ar' => 'عسير'], 'country_id' => 2],
            ['name' => ['en' => 'Tabuk', 'ar' => 'تبوك'], 'country_id' => 2],
            ['name' => ['en' => 'Hail', 'ar' => 'حائل'], 'country_id' => 2],
            ['name' => ['en' => 'Al-Jawf', 'ar' => 'الجوف'], 'country_id' => 2],
            ['name' => ['en' => 'Jizan', 'ar' => 'جازان'], 'country_id' => 2],
            ['name' => ['en' => 'Najran', 'ar' => 'نجران'], 'country_id' => 2],
            ['name' => ['en' => 'Al-Baha', 'ar' => 'الباحة'], 'country_id' => 2],
            ['name' => ['en' => 'Northern Borders', 'ar' => 'الحدود الشمالية'], 'country_id' => 2],
            ['name' => ['en' => 'Al-Qassim', 'ar' => 'القصيم'], 'country_id' => 2],


            // sudan
            ['name' => ['en' => 'Khartoum', 'ar' => 'الخرطوم'], 'country_id' => 3],
            ['name' => ['en' => 'Gezira', 'ar' => 'الجزيرة'], 'country_id' => 3],
            ['name' => ['en' => 'River Nile', 'ar' => 'نهر النيل'], 'country_id' => 3],
            ['name' => ['en' => 'North Kordofan', 'ar' => 'شمال كردفان'], 'country_id' => 3],
            ['name' => ['en' => 'South Kordofan', 'ar' => 'جنوب كردفان'], 'country_id' => 3],
            ['name' => ['en' => 'North Darfur', 'ar' => 'شمال دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'South Darfur', 'ar' => 'جنوب دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'West Darfur', 'ar' => 'غرب دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'East Darfur', 'ar' => 'شرق دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'Central Darfur', 'ar' => 'وسط دارفور'], 'country_id' => 3],
            ['name' => ['en' => 'Northern State', 'ar' => 'الولاية الشمالية'], 'country_id' => 3],
            ['name' => ['en' => 'White Nile', 'ar' => 'النيل الأبيض'], 'country_id' => 3],
            ['name' => ['en' => 'Blue Nile', 'ar' => 'النيل الأزرق'], 'country_id' => 3],
            ['name' => ['en' => 'Sennar', 'ar' => 'سنار'], 'country_id' => 3],
            ['name' => ['en' => 'Kassala', 'ar' => 'كسلا'], 'country_id' => 3],
            ['name' => ['en' => 'Gedaref', 'ar' => 'القضارف'], 'country_id' => 3],
            ['name' => ['en' => 'West Kordofan', 'ar' => 'غرب كردفان'], 'country_id' => 3],

            // emarats
            ['name' => ['en' => 'Abu Dhabi', 'ar' => 'أبوظبي'], 'country_id' => 4],
            ['name' => ['en' => 'Dubai', 'ar' => 'دبي'], 'country_id' => 4],
            ['name' => ['en' => 'Sharjah', 'ar' => 'الشارقة'], 'country_id' => 4],
            ['name' => ['en' => 'Ajman', 'ar' => 'عجمان'], 'country_id' => 4],
            ['name' => ['en' => 'Umm Al Quwain', 'ar' => 'أم القيوين'], 'country_id' => 4],
            ['name' => ['en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'], 'country_id' => 4],
            ['name' => ['en' => 'Fujairah', 'ar' => 'الفجيرة'], 'country_id' => 4],

            // moarco
            ['name' => ['en' => 'Rabat-Salé-Kénitra', 'ar' => 'الرباط-سلا-القنيطرة'], 'country_id' => 5],
            ['name' => ['en' => 'Casablanca-Settat', 'ar' => 'الدار البيضاء-سطات'], 'country_id' => 5],
            ['name' => ['en' => 'Marrakech-Safi', 'ar' => 'مراكش-آسفي'], 'country_id' => 5],
            ['name' => ['en' => 'Fès-Meknès', 'ar' => 'فاس-مكناس'], 'country_id' => 5],
            ['name' => ['en' => 'Tanger-Tetouan-Al Hoceima', 'ar' => 'طنجة-تطوان-الحسيمة'], 'country_id' => 5],
            ['name' => ['en' => 'Oriental', 'ar' => 'الشرق'], 'country_id' => 5],
            ['name' => ['en' => 'Béni Mellal-Khénifra', 'ar' => 'بني ملال-خنيفرة'], 'country_id' => 5],
            ['name' => ['en' => 'Drâa-Tafilalet', 'ar' => 'درعة-تافيلالت'], 'country_id' => 5],
            ['name' => ['en' => 'Souss-Massa', 'ar' => 'سوس-ماسة'], 'country_id' => 5],
            ['name' => ['en' => 'Guelmim-Oued Noun', 'ar' => 'كلميم-واد نون'], 'country_id' => 5],
            ['name' => ['en' => 'Laâyoune-Sakia El Hamra', 'ar' => 'العيون-الساقية الحمراء'], 'country_id' => 5],
            ['name' => ['en' => 'Dakhla-Oued Ed-Dahab', 'ar' => 'الداخلة-وادي الذهب'], 'country_id' => 5],


        ];

        foreach ($governorates as $governorate) {

        $gov =    Governorate::create($governorate);

        ShippingGovernorate::create([
            'governorate_id' => $gov->id,
            'price' => 100,
        ]);
        }
    }
}
