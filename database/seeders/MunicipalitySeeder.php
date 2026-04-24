<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipality;

class MunicipalitySeeder extends Seeder
{
    public function run(): void
    {
        // قائمة البلديات المستخرجة من locations في سيدر المحاكم
        $municipalities = [
            // ولاية 1: أدرار
            ['name' => 'أدرار', 'wilaya_id' => 1],
            ['name' => 'رقان', 'wilaya_id' => 1],
            ['name' => 'أولف', 'wilaya_id' => 1],
            ['name' => 'زاوية كنتة', 'wilaya_id' => 1],
            ['name' => 'تمنطيط', 'wilaya_id' => 1],
            ['name' => 'شروين', 'wilaya_id' => 1],
            // ولاية 2: الشلف
            ['name' => 'الشلف', 'wilaya_id' => 2],
            ['name' => 'تنس', 'wilaya_id' => 2],
            ['name' => 'بوقادير', 'wilaya_id' => 2],
            ['name' => 'أولاد فارس', 'wilaya_id' => 2],
            ['name' => 'وادي الفضة', 'wilaya_id' => 2],
            ['name' => 'الكريمية', 'wilaya_id' => 2],
            // ولاية 3: الأغواط
            ['name' => 'الأغواط', 'wilaya_id' => 3],
            ['name' => 'أفلو', 'wilaya_id' => 3],
            ['name' => 'قصر الحيران', 'wilaya_id' => 3],
            ['name' => 'حاسي الرمل', 'wilaya_id' => 3],
            // ولاية 4: أم البواقي
            ['name' => 'أم البواقي', 'wilaya_id' => 4],
            ['name' => 'عين البيضاء', 'wilaya_id' => 4],
            ['name' => 'عين مليلة', 'wilaya_id' => 4],
            ['name' => 'مسكيانة', 'wilaya_id' => 4],
            ['name' => 'سيقوس', 'wilaya_id' => 4],
            // ولاية 5: باتنة
            ['name' => 'باتنة', 'wilaya_id' => 5],
            ['name' => 'بريكة', 'wilaya_id' => 5],
            ['name' => 'عين التوتة', 'wilaya_id' => 5],
            ['name' => 'مروانة', 'wilaya_id' => 5],
            ['name' => 'نقاوس', 'wilaya_id' => 5],
            ['name' => 'رأس العيون', 'wilaya_id' => 5],
            // ولاية 6: بجاية
            ['name' => 'بجاية', 'wilaya_id' => 6],
            ['name' => 'أقبو', 'wilaya_id' => 6],
            ['name' => 'خراطة', 'wilaya_id' => 6],
            ['name' => 'سيدي عيش', 'wilaya_id' => 6],
            ['name' => 'أوقاس', 'wilaya_id' => 6],
            // ولاية 7: بسكرة
            ['name' => 'بسكرة', 'wilaya_id' => 7],
            ['name' => 'طولقة', 'wilaya_id' => 7],
            ['name' => 'أورلال', 'wilaya_id' => 7],
            ['name' => 'سيدي عقبة', 'wilaya_id' => 7],
            // ولاية 8: بشار
            ['name' => 'بشار', 'wilaya_id' => 8],
            ['name' => 'بني ونيف', 'wilaya_id' => 8],
            ['name' => 'العبادلة', 'wilaya_id' => 8],
            ['name' => 'القنادسة', 'wilaya_id' => 8],
            // ولاية 9: البليدة
            ['name' => 'البليدة', 'wilaya_id' => 9],
            ['name' => 'بوفاريك', 'wilaya_id' => 9],
            ['name' => 'العفرون', 'wilaya_id' => 9],
            ['name' => 'موزاية', 'wilaya_id' => 9],
            ['name' => 'أولاد يعيش', 'wilaya_id' => 9],
            // ولاية 10: البويرة
            ['name' => 'البويرة', 'wilaya_id' => 10],
            ['name' => 'سور الغزلان', 'wilaya_id' => 10],
            ['name' => 'الأخضرية', 'wilaya_id' => 10],
            ['name' => 'مشدالة', 'wilaya_id' => 10],
            // ولاية 11: تمنراست
            ['name' => 'تمنراست', 'wilaya_id' => 11],
            ['name' => 'عين صالح', 'wilaya_id' => 11],
            ['name' => 'إن قزام', 'wilaya_id' => 11],
            // ولاية 12: تبسة
            ['name' => 'تبسة', 'wilaya_id' => 12],
            ['name' => 'بئر العاتر', 'wilaya_id' => 12],
            ['name' => 'الشريعة', 'wilaya_id' => 12],
            ['name' => 'الماء الأبيض', 'wilaya_id' => 12],
            // ولاية 13: تلمسان
            ['name' => 'تلمسان', 'wilaya_id' => 13],
            ['name' => 'مغنية', 'wilaya_id' => 13],
            ['name' => 'الغزوات', 'wilaya_id' => 13],
            ['name' => 'الرمشي', 'wilaya_id' => 13],
            ['name' => 'سبدو', 'wilaya_id' => 13],
            // ولاية 14: تيارت
            ['name' => 'تيارت', 'wilaya_id' => 14],
            ['name' => 'السوقر', 'wilaya_id' => 14],
            ['name' => 'فرندة', 'wilaya_id' => 14],
            ['name' => 'قصر الشلالة', 'wilaya_id' => 14],
            // ولاية 15: تيزي وزو
            ['name' => 'تيزي وزو', 'wilaya_id' => 15],
            ['name' => 'عزازقة', 'wilaya_id' => 15],
            ['name' => 'ذراع الميزان', 'wilaya_id' => 15],
            ['name' => 'تيقزيرت', 'wilaya_id' => 15],
            // ولاية 16: الجزائر
            ['name' => 'الجزائر', 'wilaya_id' => 16],
            ['name' => 'سيدي امحمد', 'wilaya_id' => 16],
            ['name' => 'الحراش', 'wilaya_id' => 16],
            ['name' => 'حسين داي', 'wilaya_id' => 16],
            ['name' => 'بئر مراد رايس', 'wilaya_id' => 16],
            ['name' => 'باب الوادي', 'wilaya_id' => 16],
            ['name' => 'الشراقة', 'wilaya_id' => 16],
            ['name' => 'الرويبة', 'wilaya_id' => 16],
            // ولاية 17: الجلفة
            ['name' => 'الجلفة', 'wilaya_id' => 17],
            ['name' => 'حاسي بحبح', 'wilaya_id' => 17],
            ['name' => 'عين وسارة', 'wilaya_id' => 17],
            ['name' => 'مسعد', 'wilaya_id' => 17],
            // ولاية 18: جيجل
            ['name' => 'جيجل', 'wilaya_id' => 18],
            ['name' => 'الطاهير', 'wilaya_id' => 18],
            ['name' => 'الميلية', 'wilaya_id' => 18],
            ['name' => 'القنار', 'wilaya_id' => 18],
            // ولاية 19: سطيف
            ['name' => 'سطيف', 'wilaya_id' => 19],
            ['name' => 'العلمة', 'wilaya_id' => 19],
            ['name' => 'عين ولمان', 'wilaya_id' => 19],
            ['name' => 'بوقاعة', 'wilaya_id' => 19],
            ['name' => 'عين آزال', 'wilaya_id' => 19],
            // ولاية 20: سعيدة
            ['name' => 'سعيدة', 'wilaya_id' => 20],
            ['name' => 'عين الحجر', 'wilaya_id' => 20],
            ['name' => 'سيدي بوبكر', 'wilaya_id' => 20],
            // ولاية 21: سكيكدة
            ['name' => 'سكيكدة', 'wilaya_id' => 21],
            ['name' => 'القل', 'wilaya_id' => 21],
            ['name' => 'عزابة', 'wilaya_id' => 21],
            ['name' => 'الحروش', 'wilaya_id' => 21],
            // ولاية 22: سيدي بلعباس
            ['name' => 'سيدي بلعباس', 'wilaya_id' => 22],
            ['name' => 'سفيزف', 'wilaya_id' => 22],
            ['name' => 'تلاغ', 'wilaya_id' => 22],
            ['name' => 'بن باديس', 'wilaya_id' => 22],
            // ولاية 23: عنابة
            ['name' => 'عنابة', 'wilaya_id' => 23],
            ['name' => 'الحجار', 'wilaya_id' => 23],
            ['name' => 'البوني', 'wilaya_id' => 23],
            ['name' => 'برحال', 'wilaya_id' => 23],
            // ولاية 24: قالمة
            ['name' => 'قالمة', 'wilaya_id' => 24],
            ['name' => 'بوشقوف', 'wilaya_id' => 24],
            ['name' => 'وادي الزناتي', 'wilaya_id' => 24],
            // ولاية 25: قسنطينة
            ['name' => 'قسنطينة', 'wilaya_id' => 25],
            ['name' => 'الخروب', 'wilaya_id' => 25],
            ['name' => 'حامة بوزيان', 'wilaya_id' => 25],
            // ولاية 26: المدية
            ['name' => 'المدية', 'wilaya_id' => 26],
            ['name' => 'البرواقية', 'wilaya_id' => 26],
            ['name' => 'بني سليمان', 'wilaya_id' => 26],
            ['name' => 'تابلاط', 'wilaya_id' => 26],
            // ولاية 27: مستغانم
            ['name' => 'مستغانم', 'wilaya_id' => 27],
            ['name' => 'عين تادلس', 'wilaya_id' => 27],
            ['name' => 'سيدي علي', 'wilaya_id' => 27],
            // ولاية 28: المسيلة
            ['name' => 'المسيلة', 'wilaya_id' => 28],
            ['name' => 'بوسعادة', 'wilaya_id' => 28],
            ['name' => 'سيدي عيسى', 'wilaya_id' => 28],
            ['name' => 'عين الملح', 'wilaya_id' => 28],
            ['name' => 'حمام ضلعة', 'wilaya_id' => 28],
            ['name' => 'مقرة', 'wilaya_id' => 28],
            // ولاية 29: معسكر
            ['name' => 'معسكر', 'wilaya_id' => 29],
            ['name' => 'المحمدية', 'wilaya_id' => 29],
            ['name' => 'سيق', 'wilaya_id' => 29],
            ['name' => 'تيغنيف', 'wilaya_id' => 29],
            ['name' => 'غريس', 'wilaya_id' => 29],
            ['name' => 'بوحنيفية', 'wilaya_id' => 29],
            // ولاية 30: ورقلة
            ['name' => 'ورقلة', 'wilaya_id' => 30],
            ['name' => 'تقرت', 'wilaya_id' => 30],
            ['name' => 'حاسي مسعود', 'wilaya_id' => 30],
            // ولاية 31: وهران
            ['name' => 'وهران', 'wilaya_id' => 31],
            ['name' => 'السانية', 'wilaya_id' => 31],
            ['name' => 'بئر الجير', 'wilaya_id' => 31],
            ['name' => 'أرزيو', 'wilaya_id' => 31],
            // ولاية 32: البيض
            ['name' => 'البيض', 'wilaya_id' => 32],
            ['name' => 'بوقطب', 'wilaya_id' => 32],
            ['name' => 'الأبيض سيدي الشيخ', 'wilaya_id' => 32],
            // ولاية 33: إليزي
            ['name' => 'إليزي', 'wilaya_id' => 33],
            ['name' => 'جانت', 'wilaya_id' => 33],
            ['name' => 'برج عمر إدريس', 'wilaya_id' => 33],
            // ولاية 34: برج بوعريريج
            ['name' => 'برج بوعريريج', 'wilaya_id' => 34],
            ['name' => 'رأس الوادي', 'wilaya_id' => 34],
            ['name' => 'المنصورة', 'wilaya_id' => 34],
            // ولاية 35: بومرداس
            ['name' => 'بومرداس', 'wilaya_id' => 35],
            ['name' => 'برج منايل', 'wilaya_id' => 35],
            ['name' => 'خميس الخشنة', 'wilaya_id' => 35],
            // ولاية 36: الطارف
            ['name' => 'الطارف', 'wilaya_id' => 36],
            ['name' => 'القالة', 'wilaya_id' => 36],
            ['name' => 'بن مهيدي', 'wilaya_id' => 36],
            // ولاية 37: تندوف
            ['name' => 'تندوف', 'wilaya_id' => 37],
            // ولاية 38: تيسمسيلت
            ['name' => 'تيسمسيلت', 'wilaya_id' => 38],
            ['name' => 'ثنية الحد', 'wilaya_id' => 38],
            // ولاية 39: الوادي
            ['name' => 'الوادي', 'wilaya_id' => 39],
            ['name' => 'قمار', 'wilaya_id' => 39],
            ['name' => 'الرقيبة', 'wilaya_id' => 39],
            // ولاية 40: خنشلة
            ['name' => 'خنشلة', 'wilaya_id' => 40],
            ['name' => 'قايس', 'wilaya_id' => 40],
            // ولاية 41: سوق أهراس
            ['name' => 'سوق أهراس', 'wilaya_id' => 41],
            ['name' => 'تاورة', 'wilaya_id' => 41],
            // ولاية 42: تيبازة
            ['name' => 'تيبازة', 'wilaya_id' => 42],
            ['name' => 'القليعة', 'wilaya_id' => 42],
            ['name' => 'شرشال', 'wilaya_id' => 42],
            // ولاية 43: ميلة
            ['name' => 'ميلة', 'wilaya_id' => 43],
            ['name' => 'شلغوم العيد', 'wilaya_id' => 43],
            // ولاية 44: عين الدفلى
            ['name' => 'عين الدفلى', 'wilaya_id' => 44],
            ['name' => 'خميس مليانة', 'wilaya_id' => 44],
            // ولاية 45: النعامة
            ['name' => 'النعامة', 'wilaya_id' => 45],
            ['name' => 'عين الصفراء', 'wilaya_id' => 45],
            // ولاية 46: عين تموشنت
            ['name' => 'عين تموشنت', 'wilaya_id' => 46],
            ['name' => 'بني صاف', 'wilaya_id' => 46],
            // ولاية 47: غرداية
            ['name' => 'غرداية', 'wilaya_id' => 47],
            ['name' => 'متليلي', 'wilaya_id' => 47],
            ['name' => 'القرارة', 'wilaya_id' => 47],
            // ولاية 48: غليزان
            ['name' => 'غليزان', 'wilaya_id' => 48],
            ['name' => 'وادي رهيو', 'wilaya_id' => 48],
            // ولايات جديدة
            ['name' => 'تيميمون', 'wilaya_id' => 49],
            ['name' => 'برج باجي مختار', 'wilaya_id' => 50],
            ['name' => 'أولاد جلال', 'wilaya_id' => 51],
            ['name' => 'بني عباس', 'wilaya_id' => 52],
            ['name' => 'إن صالح', 'wilaya_id' => 53],
            ['name' => 'إن قزام', 'wilaya_id' => 54],
            ['name' => 'تقرت', 'wilaya_id' => 55],
            ['name' => 'جانت', 'wilaya_id' => 56],
            ['name' => 'المغير', 'wilaya_id' => 57],
            ['name' => 'المنيعة', 'wilaya_id' => 58],
        ];

        foreach ($municipalities as $item) {
            Municipality::updateOrCreate(
                ['name' => $item['name'], 'wilaya_id' => $item['wilaya_id']],
                []
            );
        }
    }
}