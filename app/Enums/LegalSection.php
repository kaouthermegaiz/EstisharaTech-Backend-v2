<?php

namespace App\Enums;

class LegalSection
{
    // ====== Tribunal (المحكمة الابتدائية) ======
    public const CIVIL = 1;
    public const PENAL = 2;
    public const VIOLATIONS = 3;
    public const URGENT = 4;
    public const FAMILY = 5;
    public const MINORS = 6;
    public const SOCIAL = 7;
    public const REAL_ESTATE = 8;
    public const MARITIME = 9;
    public const COMMERCIAL = 10;

    // ====== Court of Appeal (المجلس القضائي) ======
    public const CIVIL_CHAMBER = 11;
    public const PENAL_CHAMBER = 12;
    public const INVESTIGATION_CHAMBER = 13;
    public const URGENT_CHAMBER = 14;
    public const FAMILY_CHAMBER = 15;
    public const MINORS_CHAMBER = 16;
    public const SOCIAL_CHAMBER = 17;
    public const REAL_ESTATE_CHAMBER = 18;
    public const MARITIME_CHAMBER = 19;
    public const COMMERCIAL_CHAMBER = 20;
    public const CRIMINAL_COURT_FIRST_INSTANCE = 21;
    public const CRIMINAL_COURT_APPEAL = 22;

    // ====== Supreme Court (المحكمة العليا) ======
    public const CIVIL_SUPREME = 23;
    public const REAL_ESTATE_SUPREME = 24;
    public const FAMILY_INHERITANCE_SUPREME = 25;
    public const COMMERCIAL_MARITIME_SUPREME = 26;
    public const SOCIAL_SUPREME = 27;
    public const CRIMINAL_SUPREME = 28;
    public const MISDEMEANOR_SUPREME = 29;
    public const PERSONAL_STATUS_SUPREME = 30;

    public static function map()
    {
        return [
            // Tribunal
            self::CIVIL => 'القسم المدني',
            self::PENAL => 'قسم الجنح',
            self::VIOLATIONS => 'قسم المخالفات',
            self::URGENT => 'القسم الاستعجالي',
            self::FAMILY => 'قسم شؤون الأسرة',
            self::MINORS => 'قسم الأحداث',
            self::SOCIAL => 'القسم الاجتماعي',
            self::REAL_ESTATE => 'القسم العقاري',
            self::MARITIME => 'القسم البحري',
            self::COMMERCIAL => 'القسم التجاري',

            // Court of Appeal
            self::CIVIL_CHAMBER => 'الغرفة المدنية',
            self::PENAL_CHAMBER => 'الغرفة الجزائية',
            self::INVESTIGATION_CHAMBER => 'غرفة الاتهام',
            self::URGENT_CHAMBER => 'الغرفة الاستعجالية',
            self::FAMILY_CHAMBER => 'غرفة شؤون الأسرة',
            self::MINORS_CHAMBER => 'غرفة الأحداث',
            self::SOCIAL_CHAMBER => 'الغرفة الاجتماعية',
            self::REAL_ESTATE_CHAMBER => 'الغرفة العقارية',
            self::MARITIME_CHAMBER => 'الغرفة البحرية',
            self::COMMERCIAL_CHAMBER => 'الغرفة التجارية',
            self::CRIMINAL_COURT_FIRST_INSTANCE => 'محكمة الجنايات الابتدائية',
            self::CRIMINAL_COURT_APPEAL => 'محكمة الجنايات الاستئنافية',

            // Supreme Court
            self::CIVIL_SUPREME => 'الغرفة المدنية (عليا)',
            self::REAL_ESTATE_SUPREME => 'الغرفة العقارية (عليا)',
            self::FAMILY_INHERITANCE_SUPREME => 'غرفة الأسرة والمواريث',
            self::COMMERCIAL_MARITIME_SUPREME => 'الغرفة التجارية والبحرية',
            self::SOCIAL_SUPREME => 'الغرفة الاجتماعية (عليا)',
            self::CRIMINAL_SUPREME => 'الغرفة الجنائية (عليا)',
            self::MISDEMEANOR_SUPREME => 'غرفة الجنح والمخالفات (عليا)',
            self::PERSONAL_STATUS_SUPREME => 'غرفة الأحوال الشخصية',
        ];
    }
}