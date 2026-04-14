<?php

namespace App\Services;

use Carbon\Carbon;

class DeadlineService
{
    public function calculateDueDate($type, $startDate)
    {
        $start = Carbon::parse($startDate);

        return match ($type) {
            // --- المادة الجزائية (قانون الإجراءات الجزائية) ---
            'criminal_opposition' => $start->addDays(10),  // المعارضة في الأحكام الغيابية
            'criminal_appeal'     => $start->addDays(10),  // استئناف الأحكام (الجنح والمخالفات)
            'criminal_cassation'  => $start->addDays(8),   // الطعن بالنقض (الجزائي)
            'custody_48h'         => $start->addHours(48), // التوقيف للنظر (القاعدة العامة)
            'custody_extension'   => $start->addDays(5),   // تمديد التوقيف في جرائم معينة

            // --- المادة المدنية (قانون الإجراءات المدنية والإدارية) ---
            'civil_appeal'        => $start->addMonth(1),   // استئناف الأحكام المدنية (شهر من التبليغ)
            'civil_opposition'    => $start->addMonth(1),   // المعارضة في الأحكام المدنية الغيابية
            'civil_cassation'     => $start->addMonths(2),  // الطعن بالنقض المدني (شهرين)
            
            // --- المادة الإدارية ---
            'admin_appeal'        => $start->addMonths(2),  // استئناف الأحكام الإدارية (شهرين)
            'admin_annulment'     => $start->addMonths(4),  // دعوى الإلغاء (4 أشهر من التبليغ/الرفض)

            // --- التقادم (أمثلة) ---
            'limitation_felony'   => $start->addYears(10),  // تقادم الدعوى العمومية في الجنايات
            'limitation_misdemeanor' => $start->addYears(3), // تقادم الدعوى العمومية في الجنح
            'limitation_debt'     => $start->addYears(15),  // التقادم المسقط للحقوق المدنية (عام)

            default => $start->addDays(15), // أجل احتياطي في حال عدم التحديد
        };
    }
}