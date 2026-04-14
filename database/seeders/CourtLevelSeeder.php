<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $levels = [
        ['id' => 1, 'name' => 'المحكمة (الدرجة الأولى)'],
        ['id' => 2, 'name' => 'المجلس القضائي (درجة الاستئناف)'],
        ['id' => 3, 'name' => 'المحكمة العليا '],
    ];
    \App\Models\CourtLevel::insert($levels);
    }
}
