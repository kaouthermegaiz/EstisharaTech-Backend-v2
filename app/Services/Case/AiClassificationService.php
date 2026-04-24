<?php
namespace App\Services\Case;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini;
use App\Enums\LegalSection;

class AiClassificationService
{
   public function analyze($description)
{
    try {
        $cacheKey = 'ai_section_' . md5($description);

        return Cache::remember($cacheKey, 86400, function () use ($description) {

            if (RateLimiter::tooManyAttempts('ai-classify-global', 15)) {
                return ['section' => 1];
            }

            $prompt = "أنت مصنف قانوني جزائري محترف. مهمتك هي تصنيف النص القانوني التالي إلى أحد الاختصاصات القضائية الجزائرية.

النص: '{$description}'

أجب برقم فقط حسب التصنيف التالي:

🏛️ المحكمة الابتدائية:
1 = القسم المدني
2 = قسم الجنح
3 = قسم المخالفات
4 = القسم الاستعجالي
5 = قسم شؤون الأسرة
6 = قسم الأحداث
7 = القسم الاجتماعي
8 = القسم العقاري
9 = القسم البحري
10 = القسم التجاري

⚖️ المجلس القضائي:
11 = الغرفة المدنية
12 = الغرفة الجزائية
13 = غرفة الاتهام
14 = الغرفة الاستعجالية
15 = غرفة شؤون الأسرة
16 = غرفة الأحداث
17 = الغرفة الاجتماعية
18 = الغرفة العقارية
19 = الغرفة البحرية
20 = الغرفة التجارية
21 = محكمة الجنايات الابتدائية
22 = محكمة الجنايات الاستئنافية

🏛️ المحكمة العليا:
23 = الغرفة المدنية (عليا)
24 = الغرفة العقارية (عليا)
25 = غرفة الأسرة والمواريث
26 = الغرفة التجارية والبحرية
27 = الغرفة الاجتماعية (عليا)
28 = الغرفة الجنائية (عليا)
29 = غرفة الجنح والمخالفات (عليا)
30 = غرفة الأحوال الشخصية

❗ قواعد مهمة:
- أجب برقم فقط بدون أي شرح أو نص إضافي
- إذا كان التصنيف غير واضح اختر الأقرب
- لا تخرج عن الأرقام من 1 إلى 30
";

            $result = Gemini::generativeModel('gemini-2.5-flash')
                ->generateContent($prompt);

            if (!$result || !$result->text()) {
                return ['section' => 1];
            }

            $number = (int) trim($result->text());

            if ($number < 1 || $number > 30) {
                $number = 1;
            }

            return ['section' => $number];
        });

    } catch (\Exception $e) {
        Log::error("AI Service Error: " . $e->getMessage());

        return ['section' => 1];
    }
}
}