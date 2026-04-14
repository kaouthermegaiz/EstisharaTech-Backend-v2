<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetitionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $categories = [

        
        ['name' => 'عرائض افتتاح الدعوى والمذكرات الجوابية'],

        
        ['name' => 'عرائض شؤون الأسرة'],

        
        ['name' => 'عرائض الدعوى الاستعجالية'],

        
        ['name' => 'عرائض الاستئناف'],

        
        ['name' => 'عرائض الطعن بالنقض'],

        
        ['name' => 'عرائض التماس إعادة النظر'],

        
        ['name' => 'عرائض ذات صفة خاصة'],

    ];

    \App\Models\PetitionCategory::insert($categories);
}
}
