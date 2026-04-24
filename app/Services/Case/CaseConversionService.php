<?php

namespace App\Services\Case;

use App\Models\{Casefile, Consultation, Court};
use Illuminate\Support\Facades\{Auth, Log};

class CaseConversionService
{
    protected $ai, $geo, $courtResolver;

    public function __construct(
        AiClassificationService $ai,
        GeoService $geo,
        CourtResolverService $courtResolver
    ) {
        $this->ai = $ai;
        $this->geo = $geo;
        $this->courtResolver = $courtResolver;
    }

    /**
     * عملية تحويل الاستشارة إلى قضية (العملية الفعلية)
     */
    public function handleAutoCaseConversion(Consultation $consultation)
    {
        if (!$consultation->client_id) {
            throw new \Exception('لا يمكن إنشاء قضية: معرف العميل مفقود.');
        }

        // 1. اتخاذ القرار المشترك (Helper)
        list($finalSection, $court, $geoData) = $this->decideCourtAndSection($consultation);

        if (!$court) {
            throw new \Exception("لم يتم تحديد محكمة صحيحة للمعطيات المقدمة.");
        }

        // 2. التصحيح الموحد (Source of Truth الوحيد)
        $normalizedSection = $this->courtResolver->normalizeSectionForCourt($finalSection, $court);

        // 3. اختيار الغرفة بناءً على القسم المصحح
        $courtroom = $this->courtResolver->findBestCourtroom($court, $normalizedSection);

        if (!$courtroom) {
            throw new \Exception("لم يتم العثور على قسم برقم: {$normalizedSection} في محكمة {$court->name}");
        }

        // 4. إنشاء القضية
        $case = Casefile::create([
            'title'        => "قضية: " . ($consultation->subject ?? 'استشارة'),
            'client_id'    => $consultation->client_id,
            'lawyer_id'    => Auth::id(),
            'courtroom_id' => $courtroom->id,
            'description'  => $consultation->description,
            'status'       => 'جديدة',
        ]);

        $consultation->update([
            'converted_to_case' => 1,
            'status' => 'accepted'
        ]);

        return $case;
    }

    /**
     * Helper لتوحيد منطق اتخاذ القرار
     */
    private function decideCourtAndSection($consultation)
    {
        $analysis = $this->ai->analyze($consultation->description);
        $section = (int) $analysis['section'];

        $finalSection = $this->forceLegalSection(
            $consultation->description,
            $section
        );

        $geo = $this->geo->extractGeo(
            $consultation->location,
            $consultation->description
        );

        // 🔥 Safety Check: التأكد من وجود الولاية قبل الإكمال
        if (!isset($geo['wilaya'])) {
            throw new \Exception("تعذر تحديد الولاية من الموقع أو الوصف المقدم.");
        }

        $resolved = $this->courtResolver->resolveLocation(
            $consultation->description,
            $geo
        );

        $court = $resolved['court'] ?? null;

        return [$finalSection, $court, $geo];
    }

    /**
     * المنطق المعزز لتحديد القسم
     */
    private function forceLegalSection($text, $aiSection)
    {
        $rules = [
            1 => ['تعويض','مسؤولية مدنية','ضرر','عقد','فسخ عقد','بطلان عقد','التزام','دين','مطالبة مالية'],
            2 => ['سرقة','ضرب','جرح','اعتداء','سب','قذف','تزوير','استعمال مزور','تهديد','ابتزاز','جنحة'],
            3 => ['مخالفة','غرامة','قانون المرور','مخالفات'],
            4 => ['استعجالي','أمر استعجالي','وقف التنفيذ','طرد استعجالي','حالة استعجال','إجراء تحفظي'],
            5 => ['طلاق','خلع','نفقة','حضانة','زيارة','زواج','فسخ الزواج','نسب','ميراث','تركة','وصاية','كفالة'],
            6 => ['قاصر','حدث','جنوح الأحداث','حماية الطفل','انحراف قاصر'],
            7 => ['عمل','عامل','طرد تعسفي','أجور','راتب','ضمان اجتماعي','حادث عمل'],
            8 => ['عقار','ملكية','حيازة','قسمة عقار','طرد','إخلاء','احتلال','رسم عقاري','أرض','بناء'],
            9 => ['سفينة','نقل بحري','تأمين بحري','حادث بحري','شحن بحري','ملاحة'],
            10 => ['شركة','تاجر','سجل تجاري','إفلاس','شيك بدون رصيد','منازعة تجارية','شريك','تجارة'],
            11 => ['الغرفة المدنية','استئناف مدني','طعون مدنية'],
            12 => ['الغرفة الجزائية','استئناف جزائي','طعون جزائية'],
            13 => ['غرفة الاتهام','تحقيق','إحالة','أمر بالإحالة'],
            14 => ['الغرفة الاستعجالية','استئناف استعجالي'],
            15 => ['غرفة شؤون الأسرة','استئناف أسرة'],
            16 => ['غرفة الأحداث','أحداث','قاصر'],
            17 => ['الغرفة الاجتماعية','عمل','ضمان اجتماعي','نزاع عمل'],
            18 => ['الغرفة العقارية','عقار','ملكية','حيازة'],
            19 => ['الغرفة البحرية','بحري','ملاحة'],
            20 => ['الغرفة التجارية','تجارة','شركة','تاجر'],
            21 => ['محكمة الجنايات الابتدائية','جناية','قتل','اغتصاب'],
            22 => ['محكمة الجنايات الاستئنافية','استئناف جنايات'],
            23 => ['نقض مدني','الغرفة المدنية العليا','مسؤولية مدنية عليا'],
            24 => ['نقض عقاري','الغرفة العقارية العليا','ملكية عقارية'],
            25 => ['نقض أسرة','مواريث','نسب','أحوال شخصية'],
            26 => ['نقض تجاري','تجارة','بحري','شيكات','إفلاس'],
            27 => ['نقض اجتماعي','عمل','ضمان اجتماعي','نزاعات عمل'],
            28 => ['نقض جزائي','جنايات','جرائم خطيرة'],
            29 => ['جنح ومخالفات عليا','جنح','مخالفات'],
            30 => ['الأحوال الشخصية','زواج','طلاق','نسب','أسرة'],
        ];

        $text = mb_strtolower($text);
        $bestMatch = null;
        $bestScore = 0;

        foreach ($rules as $code => $keywords) {
            $score = 0;
            foreach ($keywords as $word) {
                if (mb_stripos($text, $word) !== false) {
                    $score += mb_strlen($word);
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMatch = $code;
            }
        }

        return $bestMatch ?? $aiSection;
    }

    /**
     * المعاينة (Preview)
     */
    public function previewConversion(Consultation $consultation)
    {
        if (!$consultation->client_id) {
            throw new \Exception('معرف العميل مفقود');
        }

        // 1. اتخاذ القرار (Helper)
        list($finalSection, $court, $geoData) = $this->decideCourtAndSection($consultation);

        if (!$court) {
            throw new \Exception("لا يمكن تحديد محكمة لهذا الموقع.");
        }

        // 2. Normalization (المكان الوحيد للتصحيح)
        $normalizedSection = $this->courtResolver->normalizeSectionForCourt($finalSection, $court);
        
        // 3. البحث عن الغرفة
        $courtroom = $this->courtResolver->findBestCourtroom($court, $normalizedSection);

        return [
            'section_code' => $normalizedSection,
            'section_name' => \App\Enums\LegalSection::map()[$normalizedSection] ?? 'غير معروف',
            'court'        => $court->name,
            'court_id'     => $court->id,
            'courtroom_id' => $courtroom?->id,
            'valid'        => $courtroom ? true : false,
        ];
    }
}