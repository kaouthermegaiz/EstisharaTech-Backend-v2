<?php

namespace App\Services\Case;

use App\Models\{Wilaya, Court, Municipality};
use Illuminate\Support\Facades\Log;

class GeoService
{
    /**
     * استخراج المعلومات الجغرافية (الولاية والمحكمة) بناءً على الموقع والوصف
     */
    public function extractGeo($location, $description)
    {
        $foundWilaya = null;

        // 1. منطق البحث الهرمي (Hierarchy Lookup)
        // أولاً: نحاول البحث عن البلدية (أدق)
        $municipality = Municipality::where('name', 'LIKE', trim($location))->first();

        if ($municipality) {
            // إذا وجدنا بلدية، نستنتج الولاية مباشرة
            $foundWilaya = Wilaya::find($municipality->wilaya_id);
        } else {
            // ثانياً: إذا لم نجد بلدية، نحاول البحث عن الولاية مباشرة
            $foundWilaya = Wilaya::where('name', 'LIKE', trim($location))->first();
        }

        // إذا لم نجد لا ولاية ولا بلدية بعد المحاولات
        if (!$foundWilaya) {
            throw new \Exception("لم يتم العثور على ولاية أو بلدية مطابقة لـ: " . $location);
        }

        // 2. جلب المحاكم الابتدائية التابعة لهذه الولاية
        $courts = Court::where('wilaya_id', $foundWilaya->id)
                       ->where('level_id', 1) // نركز فقط على المحاكم الابتدائية
                       ->get();

        $foundCourt = null;

        // 3. مطابقة المحكمة (البحث في النص والوصف)
        foreach ($courts as $court) {
            if (
                mb_stripos($location, $court->location) !== false || 
                mb_stripos($description, $court->location) !== false
            ) {
                $foundCourt = $court;
                break;
            }
        }

        // 4. Fallback: إذا لم نجد محكمة محددة، نختار المحكمة الرئيسية للولاية
        if (!$foundCourt) {
            $foundCourt = $courts->where('name', 'LIKE', '%' . $foundWilaya->name . '%')->first();
        }

        // 5. التحقق النهائي
        if (!$foundCourt) {
            throw new \Exception("لا توجد محكمة مسجلة في الولاية: " . $foundWilaya->name);
        }

        return [
            'wilaya' => $foundWilaya,
            'court'  => $foundCourt
        ];
    }
}