<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Attribute::truncate();
        AttributeValue::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $sizeAttribute = Attribute::create(['name' => ['en' => 'Size', 'ar' => 'الحجم']]);
        $sizeAttribute->attributeValues()->createMany([
            ['value' => ['en' => 'Small', 'ar' => 'صغير']],
            ['value' => ['en' => 'Medium', 'ar' => 'متوسط']],
            ['value' => ['en' => 'Large', 'ar' => 'كبير']],
        ]);

        $colorAttribute = Attribute::create(['name' => ['en' => 'Color', 'ar' => 'اللون']]);

        $colorAttribute->attributeValues()->createMany([
            ['value' => ['en' => 'Red', 'ar' => 'أحمر']],
            ['value' => ['en' => 'Green', 'ar' => 'أخضر']],
            ['value' => ['en' => 'Blue', 'ar' => 'أزرق']],
        ]);
        
        
    }
}
