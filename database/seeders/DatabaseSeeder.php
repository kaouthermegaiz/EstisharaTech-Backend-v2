<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;
use App\Models\Wilaya;
use App\Models\MunicipalityCourt;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. تشغيل الثوابت والبيانات المساعدة أولاً
        // ملاحظة: قمنا بتشغيل MunicipalityCourtSeeder لملء جدول البلديات الذي تفضله
        $this->call([
            WilayaSeeder::class,//جميع ولايات الجزاير مثال ['id' => 1, 'name' => 'أدرار']
            MunicipalitySeeder::class,// جميع البلديات مع ربطها بالولايات (مثال: ['id' => 1, 'name' => 'أدرار', 'wilaya_id' => 1])
            CourtLevelSeeder::class,// مستويات المحاكم (ابتدائية، استئناف، عليا)
            CourtSeeder::class, // المحاكم الرئيسية (ابتدائية واستئناف) مع المواقع الجغرافية الدقيقة
            PetitionCategorySeeder::class,// فئات العرائض (جنائية، مدنية، إدارية)
            PetitionTemplateSeeder::class,// قوالب العرائض الجاهزة لكل فئة
        ]);

        // 2. مصفوفة البيانات القضائية الأساسية (للمجالس والمحاكم الكبرى)
        
        // 3. دمج البيانات ونقل "المواقع" (Locations) من MunicipalityCourt لضمان الدقة
        

        // 4. المحكمة العليا (مستوى 3)
        Court::updateOrCreate(
            ['name' => 'المحكمة العليا'],
            ['level_id' => 3, 'wilaya_id' => null, 'location' => 'الجزائر']
        );

        // 5. تشغيل سيدر الأقسام والغرف بناءً على المحاكم التي تم إنشاؤها وتحديثها
        $this->call([
            CourtroomSeeder::class,// الأقسام والغرف المرتبطة بكل محكمة (تستخدم بيانات المحاكم المحدثة)
        ]);
    }
}