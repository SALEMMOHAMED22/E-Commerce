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
            [
                'name' => ['en' => 'category 1' , 'ar' => 'القسم الاول'],
                'status' => 1,
                'parent' => null,
                'icon' => 'icon.jpeg',
            ],
            [
                'name' => ['en' => 'category 2' , 'ar' => 'القسم الثاني'],
                'status' => 1,
                'parent' => null,
                'icon' => 'icon.jpeg',
            ],
            [
                'name' => ['en' => 'category 3' , 'ar' => 'القسم الثالث'],
                'status' => 1,
                'parent' => null,
                'icon' => 'icon.jpeg',
            ],
            [
                'name' => ['en' => 'category 4' , 'ar' => 'القسم الرايع'],
                'status' => 1,
                'parent' => null,
                'icon' => 'icon.jpeg',
            ],
        ];

        foreach ($data as $category) {
            Category::create($category);
        }
    }
}
