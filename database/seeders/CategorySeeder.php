<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            ['name' => ['en' => 'Construction', 'ar' => 'البناء'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Agriculture', 'ar' => 'الزراعة'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Transportation', 'ar' => 'النقل'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Mining', 'ar' => 'التعدين'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Forestry', 'ar' => 'الغابات'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Waste Management', 'ar' => 'إدارة النفايات'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Road Maintenance', 'ar' => 'صيانة الطرق'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Demolition', 'ar' => 'الهدم'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Landscaping', 'ar' => 'تنسيق الحدائق'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Snow Removal', 'ar' => 'إزالة الثلوج'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Asphalt Paving', 'ar' => 'رصف الأسفلت'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Concrete Work', 'ar' => 'أعمال الخرسانة'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Pipeline Installation', 'ar' => 'تركيب الأنابيب'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Drilling', 'ar' => 'الحفر'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Cranes & Lifting', 'ar' => 'الرافعات والرفع'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Utilities', 'ar' => 'الخدمات'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Quarrying', 'ar' => 'المحاجر'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
            ['name' => ['en' => 'Oil & Gas', 'ar' => 'النفط والغاز'], 'status' => 1, 'parent' => null, 'icon' => 'icon.jpeg'],
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }
}
