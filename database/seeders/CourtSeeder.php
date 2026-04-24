<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        $courts = [
            // ولاية 1: أدرار
            ['name' => 'مجلس قضاء أدرار', 'wilaya_id' => 1, 'level_id' => 2, 'location' => 'أدرار'],
            ['name' => 'محكمة أدرار', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'أدرار'],
            ['name' => 'محكمة رقان', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'رقان'],
            ['name' => 'محكمة أولف', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'أولف'],
            ['name' => 'محكمة زاوية كنتة', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'زاوية كنتة'],
            ['name' => 'محكمة تمنطيط', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'تمنطيط'],
            ['name' => 'محكمة شروين', 'wilaya_id' => 1, 'level_id' => 1, 'location' => 'شروين'],

            // ولاية 2: الشلف
            ['name' => 'مجلس قضاء الشلف', 'wilaya_id' => 2, 'level_id' => 2, 'location' => 'الشلف'],
            ['name' => 'محكمة الشلف', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'الشلف'],
            ['name' => 'محكمة تنس', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'تنس'],
            ['name' => 'محكمة بوقادير', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'بوقادير'],
            ['name' => 'محكمة أولاد فارس', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'أولاد فارس'],
            ['name' => 'محكمة وادي الفضة', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'وادي الفضة'],
            ['name' => 'محكمة الكريمية', 'wilaya_id' => 2, 'level_id' => 1, 'location' => 'الكريمية'],

            // ولاية 3: الأغواط
            ['name' => 'مجلس قضاء الأغواط', 'wilaya_id' => 3, 'level_id' => 2, 'location' => 'الأغواط'],
            ['name' => 'محكمة الأغواط', 'wilaya_id' => 3, 'level_id' => 1, 'location' => 'الأغواط'],
            ['name' => 'محكمة أفلو', 'wilaya_id' => 3, 'level_id' => 1, 'location' => 'أفلو'],
            ['name' => 'محكمة قصر الحيران', 'wilaya_id' => 3, 'level_id' => 1, 'location' => 'قصر الحيران'],
            ['name' => 'محكمة حاسي الرمل', 'wilaya_id' => 3, 'level_id' => 1, 'location' => 'حاسي الرمل'],

            // ولاية 4: أم البواقي
            ['name' => 'مجلس قضاء أم البواقي', 'wilaya_id' => 4, 'level_id' => 2, 'location' => 'أم البواقي'],
            ['name' => 'محكمة أم البواقي', 'wilaya_id' => 4, 'level_id' => 1, 'location' => 'أم البواقي'],
            ['name' => 'محكمة عين البيضاء', 'wilaya_id' => 4, 'level_id' => 1, 'location' => 'عين البيضاء'],
            ['name' => 'محكمة عين مليلة', 'wilaya_id' => 4, 'level_id' => 1, 'location' => 'عين مليلة'],
            ['name' => 'محكمة مسكيانة', 'wilaya_id' => 4, 'level_id' => 1, 'location' => 'مسكيانة'],
            ['name' => 'محكمة سيقوس', 'wilaya_id' => 4, 'level_id' => 1, 'location' => 'سيقوس'],

            // ولاية 5: باتنة
            ['name' => 'مجلس قضاء باتنة', 'wilaya_id' => 5, 'level_id' => 2, 'location' => 'باتنة'],
            ['name' => 'محكمة باتنة', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'باتنة'],
            ['name' => 'محكمة بريكة', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'بريكة'],
            ['name' => 'محكمة عين التوتة', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'عين التوتة'],
            ['name' => 'محكمة مروانة', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'مروانة'],
            ['name' => 'محكمة نقاوس', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'نقاوس'],
            ['name' => 'محكمة رأس العيون', 'wilaya_id' => 5, 'level_id' => 1, 'location' => 'رأس العيون'],

            // ولاية 6: بجاية
            ['name' => 'مجلس قضاء بجاية', 'wilaya_id' => 6, 'level_id' => 2, 'location' => 'بجاية'],
            ['name' => 'محكمة بجاية', 'wilaya_id' => 6, 'level_id' => 1, 'location' => 'بجاية'],
            ['name' => 'محكمة أقبو', 'wilaya_id' => 6, 'level_id' => 1, 'location' => 'أقبو'],
            ['name' => 'محكمة خراطة', 'wilaya_id' => 6, 'level_id' => 1, 'location' => 'خراطة'],
            ['name' => 'محكمة سيدي عيش', 'wilaya_id' => 6, 'level_id' => 1, 'location' => 'سيدي عيش'],
            ['name' => 'محكمة أوقاس', 'wilaya_id' => 6, 'level_id' => 1, 'location' => 'أوقاس'],

            // ولاية 7: بسكرة
            ['name' => 'مجلس قضاء بسكرة', 'wilaya_id' => 7, 'level_id' => 2, 'location' => 'بسكرة'],
            ['name' => 'محكمة بسكرة', 'wilaya_id' => 7, 'level_id' => 1, 'location' => 'بسكرة'],
            ['name' => 'محكمة طولقة', 'wilaya_id' => 7, 'level_id' => 1, 'location' => 'طولقة'],
            ['name' => 'محكمة أورلال', 'wilaya_id' => 7, 'level_id' => 1, 'location' => 'أورلال'],
            ['name' => 'محكمة سيدي عقبة', 'wilaya_id' => 7, 'level_id' => 1, 'location' => 'سيدي عقبة'],

            // ولاية 8: بشار
            ['name' => 'مجلس قضاء بشار', 'wilaya_id' => 8, 'level_id' => 2, 'location' => 'بشار'],
            ['name' => 'محكمة بشار', 'wilaya_id' => 8, 'level_id' => 1, 'location' => 'بشار'],
            ['name' => 'محكمة بني ونيف', 'wilaya_id' => 8, 'level_id' => 1, 'location' => 'بني ونيف'],
            ['name' => 'محكمة العبادلة', 'wilaya_id' => 8, 'level_id' => 1, 'location' => 'العبادلة'],
            ['name' => 'محكمة القنادسة', 'wilaya_id' => 8, 'level_id' => 1, 'location' => 'القنادسة'],

            // ولاية 9: البليدة
            ['name' => 'مجلس قضاء البليدة', 'wilaya_id' => 9, 'level_id' => 2, 'location' => 'البليدة'],
            ['name' => 'محكمة البليدة', 'wilaya_id' => 9, 'level_id' => 1, 'location' => 'البليدة'],
            ['name' => 'محكمة بوفاريك', 'wilaya_id' => 9, 'level_id' => 1, 'location' => 'بوفاريك'],
            ['name' => 'محكمة العفرون', 'wilaya_id' => 9, 'level_id' => 1, 'location' => 'العفرون'],
            ['name' => 'محكمة موزاية', 'wilaya_id' => 9, 'level_id' => 1, 'location' => 'موزاية'],
            ['name' => 'محكمة أولاد يعيش', 'wilaya_id' => 9, 'level_id' => 1, 'location' => 'أولاد يعيش'],

            // ولاية 10: البويرة
            ['name' => 'مجلس قضاء البويرة', 'wilaya_id' => 10, 'level_id' => 2, 'location' => 'البويرة'],
            ['name' => 'محكمة البويرة', 'wilaya_id' => 10, 'level_id' => 1, 'location' => 'البويرة'],
            ['name' => 'محكمة سور الغزلان', 'wilaya_id' => 10, 'level_id' => 1, 'location' => 'سور الغزلان'],
            ['name' => 'محكمة الأخضرية', 'wilaya_id' => 10, 'level_id' => 1, 'location' => 'الأخضرية'],
            ['name' => 'محكمة مشدالة', 'wilaya_id' => 10, 'level_id' => 1, 'location' => 'مشدالة'],

            // ولاية 11: تمنراست
            ['name' => 'مجلس قضاء تمنراست', 'wilaya_id' => 11, 'level_id' => 2, 'location' => 'تمنراست'],
            ['name' => 'محكمة تمنراست', 'wilaya_id' => 11, 'level_id' => 1, 'location' => 'تمنراست'],
            ['name' => 'محكمة عين صالح', 'wilaya_id' => 11, 'level_id' => 1, 'location' => 'عين صالح'],
            ['name' => 'محكمة إن قزام', 'wilaya_id' => 11, 'level_id' => 1, 'location' => 'إن قزام'],

            // ولاية 12: تبسة
            ['name' => 'مجلس قضاء تبسة', 'wilaya_id' => 12, 'level_id' => 2, 'location' => 'تبسة'],
            ['name' => 'محكمة تبسة', 'wilaya_id' => 12, 'level_id' => 1, 'location' => 'تبسة'],
            ['name' => 'محكمة بئر العاتر', 'wilaya_id' => 12, 'level_id' => 1, 'location' => 'بئر العاتر'],
            ['name' => 'محكمة الشريعة', 'wilaya_id' => 12, 'level_id' => 1, 'location' => 'الشريعة'],
            ['name' => 'محكمة الماء الأبيض', 'wilaya_id' => 12, 'level_id' => 1, 'location' => 'الماء الأبيض'],

            // ولاية 13: تلمسان
            ['name' => 'مجلس قضاء تلمسان', 'wilaya_id' => 13, 'level_id' => 2, 'location' => 'تلمسان'],
            ['name' => 'محكمة تلمسان', 'wilaya_id' => 13, 'level_id' => 1, 'location' => 'تلمسان'],
            ['name' => 'محكمة مغنية', 'wilaya_id' => 13, 'level_id' => 1, 'location' => 'مغنية'],
            ['name' => 'محكمة الغزوات', 'wilaya_id' => 13, 'level_id' => 1, 'location' => 'الغزوات'],
            ['name' => 'محكمة الرمشي', 'wilaya_id' => 13, 'level_id' => 1, 'location' => 'الرمشي'],
            ['name' => 'محكمة سبدو', 'wilaya_id' => 13, 'level_id' => 1, 'location' => 'سبدو'],

            // ولاية 14: تيارت
            ['name' => 'مجلس قضاء تيارت', 'wilaya_id' => 14, 'level_id' => 2, 'location' => 'تيارت'],
            ['name' => 'محكمة تيارت', 'wilaya_id' => 14, 'level_id' => 1, 'location' => 'تيارت'],
            ['name' => 'محكمة السوقر', 'wilaya_id' => 14, 'level_id' => 1, 'location' => 'السوقر'],
            ['name' => 'محكمة فرندة', 'wilaya_id' => 14, 'level_id' => 1, 'location' => 'فرندة'],
            ['name' => 'محكمة قصر الشلالة', 'wilaya_id' => 14, 'level_id' => 1, 'location' => 'قصر الشلالة'],

            // ولاية 15: تيزي وزو
            ['name' => 'مجلس قضاء تيزي وزو', 'wilaya_id' => 15, 'level_id' => 2, 'location' => 'تيزي وزو'],
            ['name' => 'محكمة تيزي وزو', 'wilaya_id' => 15, 'level_id' => 1, 'location' => 'تيزي وزو'],
            ['name' => 'محكمة عزازقة', 'wilaya_id' => 15, 'level_id' => 1, 'location' => 'عزازقة'],
            ['name' => 'محكمة ذراع الميزان', 'wilaya_id' => 15, 'level_id' => 1, 'location' => 'ذراع الميزان'],
            ['name' => 'محكمة تيقزيرت', 'wilaya_id' => 15, 'level_id' => 1, 'location' => 'تيقزيرت'],

            // ولاية 16: الجزائر
            ['name' => 'مجلس قضاء الجزائر', 'wilaya_id' => 16, 'level_id' => 2, 'location' => 'الجزائر'],
            ['name' => 'محكمة سيدي امحمد', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'سيدي امحمد'],
            ['name' => 'محكمة الحراش', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'الحراش'],
            ['name' => 'محكمة حسين داي', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'حسين داي'],
            ['name' => 'محكمة بئر مراد رايس', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'بئر مراد رايس'],
            ['name' => 'محكمة باب الوادي', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'باب الوادي'],
            ['name' => 'محكمة الشراقة', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'الشراقة'],
            ['name' => 'محكمة الرويبة', 'wilaya_id' => 16, 'level_id' => 1, 'location' => 'الرويبة'],

            // ولاية 17: الجلفة
            ['name' => 'مجلس قضاء الجلفة', 'wilaya_id' => 17, 'level_id' => 2, 'location' => 'الجلفة'],
            ['name' => 'محكمة الجلفة', 'wilaya_id' => 17, 'level_id' => 1, 'location' => 'الجلفة'],
            ['name' => 'محكمة حاسي بحبح', 'wilaya_id' => 17, 'level_id' => 1, 'location' => 'حاسي بحبح'],
            ['name' => 'محكمة عين وسارة', 'wilaya_id' => 17, 'level_id' => 1, 'location' => 'عين وسارة'],
            ['name' => 'محكمة مسعد', 'wilaya_id' => 17, 'level_id' => 1, 'location' => 'مسعد'],

            // ولاية 18: جيجل
            ['name' => 'مجلس قضاء جيجل', 'wilaya_id' => 18, 'level_id' => 2, 'location' => 'جيجل'],
            ['name' => 'محكمة جيجل', 'wilaya_id' => 18, 'level_id' => 1, 'location' => 'جيجل'],
            ['name' => 'محكمة الطاهير', 'wilaya_id' => 18, 'level_id' => 1, 'location' => 'الطاهير'],
            ['name' => 'محكمة الميلية', 'wilaya_id' => 18, 'level_id' => 1, 'location' => 'الميلية'],
            ['name' => 'محكمة القنار', 'wilaya_id' => 18, 'level_id' => 1, 'location' => 'القنار'],

            // ولاية 19: سطيف
            ['name' => 'مجلس قضاء سطيف', 'wilaya_id' => 19, 'level_id' => 2, 'location' => 'سطيف'],
            ['name' => 'محكمة سطيف', 'wilaya_id' => 19, 'level_id' => 1, 'location' => 'سطيف'],
            ['name' => 'محكمة العلمة', 'wilaya_id' => 19, 'level_id' => 1, 'location' => 'العلمة'],
            ['name' => 'محكمة عين ولمان', 'wilaya_id' => 19, 'level_id' => 1, 'location' => 'عين ولمان'],
            ['name' => 'محكمة بوقاعة', 'wilaya_id' => 19, 'level_id' => 1, 'location' => 'بوقاعة'],
            ['name' => 'محكمة عين آزال', 'wilaya_id' => 19, 'level_id' => 1, 'location' => 'عين آزال'],

            // ولاية 20: سعيدة
            ['name' => 'مجلس قضاء سعيدة', 'wilaya_id' => 20, 'level_id' => 2, 'location' => 'سعيدة'],
            ['name' => 'محكمة سعيدة', 'wilaya_id' => 20, 'level_id' => 1, 'location' => 'سعيدة'],
            ['name' => 'محكمة عين الحجر', 'wilaya_id' => 20, 'level_id' => 1, 'location' => 'عين الحجر'],
            ['name' => 'محكمة سيدي بوبكر', 'wilaya_id' => 20, 'level_id' => 1, 'location' => 'سيدي بوبكر'],

            // ولاية 21: سكيكدة
            ['name' => 'مجلس قضاء سكيكدة', 'wilaya_id' => 21, 'level_id' => 2, 'location' => 'سكيكدة'],
            ['name' => 'محكمة سكيكدة', 'wilaya_id' => 21, 'level_id' => 1, 'location' => 'سكيكدة'],
            ['name' => 'محكمة القل', 'wilaya_id' => 21, 'level_id' => 1, 'location' => 'القل'],
            ['name' => 'محكمة عزابة', 'wilaya_id' => 21, 'level_id' => 1, 'location' => 'عزابة'],
            ['name' => 'محكمة الحروش', 'wilaya_id' => 21, 'level_id' => 1, 'location' => 'الحروش'],

            // ولاية 22: سيدي بلعباس
            ['name' => 'مجلس قضاء سيدي بلعباس', 'wilaya_id' => 22, 'level_id' => 2, 'location' => 'سيدي بلعباس'],
            ['name' => 'محكمة سيدي بلعباس', 'wilaya_id' => 22, 'level_id' => 1, 'location' => 'سيدي بلعباس'],
            ['name' => 'محكمة سفيزف', 'wilaya_id' => 22, 'level_id' => 1, 'location' => 'سفيزف'],
            ['name' => 'محكمة تلاغ', 'wilaya_id' => 22, 'level_id' => 1, 'location' => 'تلاغ'],
            ['name' => 'محكمة بن باديس', 'wilaya_id' => 22, 'level_id' => 1, 'location' => 'بن باديس'],

            // ولاية 23: عنابة
            ['name' => 'مجلس قضاء عنابة', 'wilaya_id' => 23, 'level_id' => 2, 'location' => 'عنابة'],
            ['name' => 'محكمة عنابة', 'wilaya_id' => 23, 'level_id' => 1, 'location' => 'عنابة'],
            ['name' => 'محكمة الحجار', 'wilaya_id' => 23, 'level_id' => 1, 'location' => 'الحجار'],
            ['name' => 'محكمة البوني', 'wilaya_id' => 23, 'level_id' => 1, 'location' => 'البوني'],
            ['name' => 'محكمة برحال', 'wilaya_id' => 23, 'level_id' => 1, 'location' => 'برحال'],

            // ولاية 24: قالمة
            ['name' => 'مجلس قضاء قالمة', 'wilaya_id' => 24, 'level_id' => 2, 'location' => 'قالمة'],
            ['name' => 'محكمة قالمة', 'wilaya_id' => 24, 'level_id' => 1, 'location' => 'قالمة'],
            ['name' => 'محكمة بوشقوف', 'wilaya_id' => 24, 'level_id' => 1, 'location' => 'بوشقوف'],
            ['name' => 'محكمة وادي الزناتي', 'wilaya_id' => 24, 'level_id' => 1, 'location' => 'وادي الزناتي'],

            // ولاية 25: قسنطينة
            ['name' => 'مجلس قضاء قسنطينة', 'wilaya_id' => 25, 'level_id' => 2, 'location' => 'قسنطينة'],
            ['name' => 'محكمة قسنطينة', 'wilaya_id' => 25, 'level_id' => 1, 'location' => 'قسنطينة'],
            ['name' => 'محكمة الخروب', 'wilaya_id' => 25, 'level_id' => 1, 'location' => 'الخروب'],
            ['name' => 'محكمة حامة بوزيان', 'wilaya_id' => 25, 'level_id' => 1, 'location' => 'حامة بوزيان'],

            // ولاية 26: المدية
            ['name' => 'مجلس قضاء المدية', 'wilaya_id' => 26, 'level_id' => 2, 'location' => 'المدية'],
            ['name' => 'محكمة المدية', 'wilaya_id' => 26, 'level_id' => 1, 'location' => 'المدية'],
            ['name' => 'محكمة البرواقية', 'wilaya_id' => 26, 'level_id' => 1, 'location' => 'البرواقية'],
            ['name' => 'محكمة بني سليمان', 'wilaya_id' => 26, 'level_id' => 1, 'location' => 'بني سليمان'],
            ['name' => 'محكمة تابلاط', 'wilaya_id' => 26, 'level_id' => 1, 'location' => 'تابلاط'],

            // ولاية 27: مستغانم
            ['name' => 'مجلس قضاء مستغانم', 'wilaya_id' => 27, 'level_id' => 2, 'location' => 'مستغانم'],
            ['name' => 'محكمة مستغانم', 'wilaya_id' => 27, 'level_id' => 1, 'location' => 'مستغانم'],
            ['name' => 'محكمة عين تادلس', 'wilaya_id' => 27, 'level_id' => 1, 'location' => 'عين تادلس'],
            ['name' => 'محكمة سيدي علي', 'wilaya_id' => 27, 'level_id' => 1, 'location' => 'سيدي علي'],

            // ولاية 28: المسيلة
            ['name' => 'مجلس قضاء المسيلة', 'wilaya_id' => 28, 'level_id' => 2, 'location' => 'المسيلة'],
            ['name' => 'محكمة المسيلة', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'المسيلة'],
            ['name' => 'محكمة بوسعادة', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'بوسعادة'],
            ['name' => 'محكمة سيدي عيسى', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'سيدي عيسى'],
            ['name' => 'محكمة عين الملح', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'عين الملح'],
            ['name' => 'محكمة حمام ضلعة', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'حمام ضلعة'],
            ['name' => 'محكمة مقرة', 'wilaya_id' => 28, 'level_id' => 1, 'location' => 'مقرة'],

            // ولاية 29: معسكر
            ['name' => 'مجلس قضاء معسكر', 'wilaya_id' => 29, 'level_id' => 2, 'location' => 'معسكر'],
            ['name' => 'محكمة معسكر', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'معسكر'],
            ['name' => 'محكمة المحمدية', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'المحمدية'],
            ['name' => 'محكمة سيق', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'سيق'],
            ['name' => 'محكمة تيغنيف', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'تيغنيف'],
            ['name' => 'محكمة غريس', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'غريس'],
            ['name' => 'محكمة بوحنيفية', 'wilaya_id' => 29, 'level_id' => 1, 'location' => 'بوحنيفية'],

            // ولاية 30: ورقلة
            ['name' => 'مجلس قضاء ورقلة', 'wilaya_id' => 30, 'level_id' => 2, 'location' => 'ورقلة'],
            ['name' => 'محكمة ورقلة', 'wilaya_id' => 30, 'level_id' => 1, 'location' => 'ورقلة'],
            ['name' => 'محكمة تقرت', 'wilaya_id' => 30, 'level_id' => 1, 'location' => 'تقرت'],
            ['name' => 'محكمة حاسي مسعود', 'wilaya_id' => 30, 'level_id' => 1, 'location' => 'حاسي مسعود'],

            // ولاية 31: وهران
            ['name' => 'مجلس قضاء وهران', 'wilaya_id' => 31, 'level_id' => 2, 'location' => 'وهران'],
            ['name' => 'محكمة وهران', 'wilaya_id' => 31, 'level_id' => 1, 'location' => 'وهران'],
            ['name' => 'محكمة السانية', 'wilaya_id' => 31, 'level_id' => 1, 'location' => 'السانية'],
            ['name' => 'محكمة بئر الجير', 'wilaya_id' => 31, 'level_id' => 1, 'location' => 'بئر الجير'],
            ['name' => 'محكمة أرزيو', 'wilaya_id' => 31, 'level_id' => 1, 'location' => 'أرزيو'],

            // ولاية 32: البيض
            ['name' => 'مجلس قضاء البيض', 'wilaya_id' => 32, 'level_id' => 2, 'location' => 'البيض'],
            ['name' => 'محكمة البيض', 'wilaya_id' => 32, 'level_id' => 1, 'location' => 'البيض'],
            ['name' => 'محكمة بوقطب', 'wilaya_id' => 32, 'level_id' => 1, 'location' => 'بوقطب'],
            ['name' => 'محكمة الأبيض سيدي الشيخ', 'wilaya_id' => 32, 'level_id' => 1, 'location' => 'الأبيض سيدي الشيخ'],

            // ولاية 33: إليزي
            ['name' => 'مجلس قضاء إليزي', 'wilaya_id' => 33, 'level_id' => 2, 'location' => 'إليزي'],
            ['name' => 'محكمة إليزي', 'wilaya_id' => 33, 'level_id' => 1, 'location' => 'إليزي'],
            ['name' => 'محكمة جانت', 'wilaya_id' => 33, 'level_id' => 1, 'location' => 'جانت'],
            ['name' => 'محكمة برج عمر إدريس', 'wilaya_id' => 33, 'level_id' => 1, 'location' => 'برج عمر إدريس'],

            // ولاية 34: برج بوعريريج
            ['name' => 'مجلس قضاء برج بوعريريج', 'wilaya_id' => 34, 'level_id' => 2, 'location' => 'برج بوعريريج'],
            ['name' => 'محكمة برج بوعريريج', 'wilaya_id' => 34, 'level_id' => 1, 'location' => 'برج بوعريريج'],
            ['name' => 'محكمة رأس الوادي', 'wilaya_id' => 34, 'level_id' => 1, 'location' => 'رأس الوادي'],
            ['name' => 'محكمة المنصورة', 'wilaya_id' => 34, 'level_id' => 1, 'location' => 'المنصورة'],

            // ولاية 35: بومرداس
            ['name' => 'مجلس قضاء بومرداس', 'wilaya_id' => 35, 'level_id' => 2, 'location' => 'بومرداس'],
            ['name' => 'محكمة بومرداس', 'wilaya_id' => 35, 'level_id' => 1, 'location' => 'بومرداس'],
            ['name' => 'محكمة برج منايل', 'wilaya_id' => 35, 'level_id' => 1, 'location' => 'برج منايل'],
            ['name' => 'محكمة خميس الخشنة', 'wilaya_id' => 35, 'level_id' => 1, 'location' => 'خميس الخشنة'],

            // ولاية 36: الطارف
            ['name' => 'مجلس قضاء الطارف', 'wilaya_id' => 36, 'level_id' => 2, 'location' => 'الطارف'],
            ['name' => 'محكمة الطارف', 'wilaya_id' => 36, 'level_id' => 1, 'location' => 'الطارف'],
            ['name' => 'محكمة القالة', 'wilaya_id' => 36, 'level_id' => 1, 'location' => 'القالة'],
            ['name' => 'محكمة بن مهيدي', 'wilaya_id' => 36, 'level_id' => 1, 'location' => 'بن مهيدي'],

            // ولاية 37: تندوف
            ['name' => 'مجلس قضاء تندوف', 'wilaya_id' => 37, 'level_id' => 2, 'location' => 'تندوف'],
            ['name' => 'محكمة تندوف', 'wilaya_id' => 37, 'level_id' => 1, 'location' => 'تندوف'],

            // ولاية 38: تيسمسيلت
            ['name' => 'مجلس قضاء تيسمسيلت', 'wilaya_id' => 38, 'level_id' => 2, 'location' => 'تيسمسيلت'],
            ['name' => 'محكمة تيسمسيلت', 'wilaya_id' => 38, 'level_id' => 1, 'location' => 'تيسمسيلت'],
            ['name' => 'محكمة ثنية الحد', 'wilaya_id' => 38, 'level_id' => 1, 'location' => 'ثنية الحد'],

            // ولاية 39: الوادي
            ['name' => 'مجلس قضاء الوادي', 'wilaya_id' => 39, 'level_id' => 2, 'location' => 'الوادي'],
            ['name' => 'محكمة الوادي', 'wilaya_id' => 39, 'level_id' => 1, 'location' => 'الوادي'],
            ['name' => 'محكمة قمار', 'wilaya_id' => 39, 'level_id' => 1, 'location' => 'قمار'],
            ['name' => 'محكمة الرقيبة', 'wilaya_id' => 39, 'level_id' => 1, 'location' => 'الرقيبة'],

            // ولاية 40: خنشلة
            ['name' => 'مجلس قضاء خنشلة', 'wilaya_id' => 40, 'level_id' => 2, 'location' => 'خنشلة'],
            ['name' => 'محكمة خنشلة', 'wilaya_id' => 40, 'level_id' => 1, 'location' => 'خنشلة'],
            ['name' => 'محكمة قايس', 'wilaya_id' => 40, 'level_id' => 1, 'location' => 'قايس'],

            // ولاية 41: سوق أهراس
            ['name' => 'مجلس قضاء سوق أهراس', 'wilaya_id' => 41, 'level_id' => 2, 'location' => 'سوق أهراس'],
            ['name' => 'محكمة سوق أهراس', 'wilaya_id' => 41, 'level_id' => 1, 'location' => 'سوق أهراس'],
            ['name' => 'محكمة تاورة', 'wilaya_id' => 41, 'level_id' => 1, 'location' => 'تاورة'],

            // ولاية 42: تيبازة
            ['name' => 'مجلس قضاء تيبازة', 'wilaya_id' => 42, 'level_id' => 2, 'location' => 'تيبازة'],
            ['name' => 'محكمة تيبازة', 'wilaya_id' => 42, 'level_id' => 1, 'location' => 'تيبازة'],
            ['name' => 'محكمة القليعة', 'wilaya_id' => 42, 'level_id' => 1, 'location' => 'القليعة'],
            ['name' => 'محكمة شرشال', 'wilaya_id' => 42, 'level_id' => 1, 'location' => 'شرشال'],

            // ولاية 43: ميلة
            ['name' => 'مجلس قضاء ميلة', 'wilaya_id' => 43, 'level_id' => 2, 'location' => 'ميلة'],
            ['name' => 'محكمة ميلة', 'wilaya_id' => 43, 'level_id' => 1, 'location' => 'ميلة'],
            ['name' => 'محكمة شلغوم العيد', 'wilaya_id' => 43, 'level_id' => 1, 'location' => 'شلغوم العيد'],

            // ولاية 44: عين الدفلى
            ['name' => 'مجلس قضاء عين الدفلى', 'wilaya_id' => 44, 'level_id' => 2, 'location' => 'عين الدفلى'],
            ['name' => 'محكمة عين الدفلى', 'wilaya_id' => 44, 'level_id' => 1, 'location' => 'عين الدفلى'],
            ['name' => 'محكمة خميس مليانة', 'wilaya_id' => 44, 'level_id' => 1, 'location' => 'خميس مليانة'],

            // ولاية 45: النعامة
            ['name' => 'مجلس قضاء النعامة', 'wilaya_id' => 45, 'level_id' => 2, 'location' => 'النعامة'],
            ['name' => 'محكمة النعامة', 'wilaya_id' => 45, 'level_id' => 1, 'location' => 'النعامة'],
            ['name' => 'محكمة عين الصفراء', 'wilaya_id' => 45, 'level_id' => 1, 'location' => 'عين الصفراء'],

            // ولاية 46: عين تموشنت
            ['name' => 'مجلس قضاء عين تموشنت', 'wilaya_id' => 46, 'level_id' => 2, 'location' => 'عين تموشنت'],
            ['name' => 'محكمة عين تموشنت', 'wilaya_id' => 46, 'level_id' => 1, 'location' => 'عين تموشنت'],
            ['name' => 'محكمة بني صاف', 'wilaya_id' => 46, 'level_id' => 1, 'location' => 'بني صاف'],

            // ولاية 47: غرداية
            ['name' => 'مجلس قضاء غرداية', 'wilaya_id' => 47, 'level_id' => 2, 'location' => 'غرداية'],
            ['name' => 'محكمة غرداية', 'wilaya_id' => 47, 'level_id' => 1, 'location' => 'غرداية'],
            ['name' => 'محكمة متليلي', 'wilaya_id' => 47, 'level_id' => 1, 'location' => 'متليلي'],
            ['name' => 'محكمة القرارة', 'wilaya_id' => 47, 'level_id' => 1, 'location' => 'القرارة'],

            // ولاية 48: غليزان
            ['name' => 'مجلس قضاء غليزان', 'wilaya_id' => 48, 'level_id' => 2, 'location' => 'غليزان'],
            ['name' => 'محكمة غليزان', 'wilaya_id' => 48, 'level_id' => 1, 'location' => 'غليزان'],
            ['name' => 'محكمة وادي رهيو', 'wilaya_id' => 48, 'level_id' => 1, 'location' => 'وادي رهيو'],

            // الولايات الجديدة (49-58)
            ['name' => 'محكمة تيميمون', 'wilaya_id' => 49, 'level_id' => 1, 'location' => 'تيميمون'],
            ['name' => 'محكمة برج باجي مختار', 'wilaya_id' => 50, 'level_id' => 1, 'location' => 'برج باجي مختار'],
            ['name' => 'محكمة أولاد جلال', 'wilaya_id' => 51, 'level_id' => 1, 'location' => 'أولاد جلال'],
            ['name' => 'محكمة بني عباس', 'wilaya_id' => 52, 'level_id' => 1, 'location' => 'بني عباس'],
            ['name' => 'محكمة إن صالح', 'wilaya_id' => 53, 'level_id' => 1, 'location' => 'إن صالح'],
            ['name' => 'محكمة إن قزام', 'wilaya_id' => 54, 'level_id' => 1, 'location' => 'إن قزام'],
            ['name' => 'محكمة تقرت', 'wilaya_id' => 55, 'level_id' => 1, 'location' => 'تقرت'],
            ['name' => 'محكمة جانت', 'wilaya_id' => 56, 'level_id' => 1, 'location' => 'جانت'],
            ['name' => 'محكمة المغير', 'wilaya_id' => 57, 'level_id' => 1, 'location' => 'المغير'],
            ['name' => 'محكمة المنيعة', 'wilaya_id' => 58, 'level_id' => 1, 'location' => 'المنيعة'],

            // المحكمة العليا
            ['name' => 'المحكمة العليا', 'wilaya_id' => null, 'level_id' => 3, 'location' => 'الجزائر'],
        ];

        foreach ($courts as $court) {
            Court::updateOrCreate(
                ['name' => $court['name']],
                [
                    'wilaya_id' => $court['wilaya_id'],
                    'level_id'  => $court['level_id'],
                    'location'  => $court['location']
                ]
            );
        }
    }
}