<?php

namespace App\Services\Case;

use App\Models\{Court, Courtroom};
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourtResolverService
{
    /**
     * تحديد الجهة القضائية بناءً على النص والبيانات الجغرافية.
     */
    public function resolveLocation(string $description, array $geoData)
{
    $text = mb_strtolower($description);
    
    // قائمة الكلمات التي تنفي وجود حكم سابق
    $negationWords = ['حكم قضائي', 'بدون', 'لا يوجد', 'غير مسبوق بـ', 'دون'];

    $appealKeywords = ['استئناف', 'نقض', 'طعن', 'قرار قضائي', 'معارضة'];

    foreach ($appealKeywords as $keyword) {
        if (mb_strpos($text, $keyword) !== false) {
            // تحقق: هل الكلمة مسبوقة بكلمة نفي؟
            $isNegated = false;
            foreach ($negationWords as $negation) {
                // نبحث إذا كان النفي موجوداً قبل الكلمة المفتاحية في النص
                if (mb_strpos($text, $negation . ' ' . $keyword) !== false) {
                    $isNegated = true;
                    break;
                }
            }

            if (!$isNegated) {
                return $this->resolveToMajlis($geoData);
            }
        }
    }

    return $this->resolveToFirstInstance($geoData);
}
    /**
     * منطق التوجيه للمحكمة الابتدائية
     */
    private function resolveToFirstInstance(array $geoData)
    {
        $court = $geoData['court'] ?? $this->findDefaultCourt($geoData['wilaya']);
        
        return [
            'court' => $court, 
            'type'  => 'mahkama'
        ];
    }

    /**
     * منطق التوجيه لمجلس القضاء
     */
    private function resolveToMajlis(array $geoData)
    {
        $majlis = Court::where('wilaya_id', $geoData['wilaya']->id)
                       ->where('name', 'LIKE', '%مجلس قضاء%')
                       ->first();

        if (!$majlis) {
            throw new \Exception("عذراً، لم يتم العثور على مجلس القضاء الخاص بهذه الولاية.");
        }

        return [
            'court' => $majlis, 
            'type'  => 'majlis'
        ];
    }

    /**
     * البحث عن محكمة ابتدائية افتراضية في حالة عدم تحديدها
     */
    private function findDefaultCourt($wilaya)
    {
        $court = Court::where('wilaya_id', $wilaya->id)
                      ->where('level_id', 1) // 1 = محكمة ابتدائية
                      ->first();

        if (!$court) {
            throw new \Exception("لا توجد محكمة ابتدائية مسجلة لولاية: " . $wilaya->name);
        }

        return $court;
    }

    /**
     * تحديد الغرفة/القسم المناسب
     */
    /**
     * تحديد الغرفة/القسم المناسب بناءً على نوع المحكمة والاسم المدخل.
     */
    public function findBestCourtroom($court, int $sectionCode)
{
    return $court->courtrooms()
        ->where('code', $sectionCode)
        ->first();
}
public function normalizeSectionForCourt($section, $court)
{
    // إذا كانت محكمة ابتدائية → OK
    if ($court->level_id == 1) {
        return $section;
    }

    // إذا مجلس قضاء → نحول 1-10 إلى 11-20
    if ($court->level_id == 2) {
        if ($section >= 1 && $section <= 10) {
            return $section + 10;
        }
    }

    // المحكمة العليا → 23+
    if ($court->level_id == 3) {
        if ($section >= 1 && $section <= 10) {
            return $section + 22;
        }
    }

    return $section;
}
}