<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;
use App\Models\Courtroom;
use App\Enums\LegalSection;

class CourtroomSeeder extends Seeder
{
    public function run(): void
    {
        $courts = Court::all();

        foreach ($courts as $court) {

            $rooms = [];

            /*
            |--------------------------------------------------------------------------
            | 1. المحكمة الابتدائية
            |--------------------------------------------------------------------------
            */
            if ($court->level_id == 1) {
                $rooms = [
                    ['name' => 'القسم المدني',        'code' => LegalSection::CIVIL],
                    ['name' => 'قسم الجنح',           'code' => LegalSection::PENAL],
                    ['name' => 'قسم المخالفات',       'code' => LegalSection::VIOLATIONS],
                    ['name' => 'القسم الاستعجالي',    'code' => LegalSection::URGENT],
                    ['name' => 'قسم شؤون الأسرة',     'code' => LegalSection::FAMILY],
                    ['name' => 'قسم الأحداث',         'code' => LegalSection::MINORS],
                    ['name' => 'القسم الاجتماعي',     'code' => LegalSection::SOCIAL],
                    ['name' => 'القسم العقاري',       'code' => LegalSection::REAL_ESTATE],
                    ['name' => 'القسم البحري',        'code' => LegalSection::MARITIME],
                    ['name' => 'القسم التجاري',       'code' => LegalSection::COMMERCIAL],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | 2. المجلس القضائي
            |--------------------------------------------------------------------------
            */
            elseif ($court->level_id == 2) {
                $rooms = [
                    ['name' => 'الغرفة المدنية',              'code' => LegalSection::CIVIL_CHAMBER],
                    ['name' => 'الغرفة الجزائية',            'code' => LegalSection::PENAL_CHAMBER],
                    ['name' => 'غرفة الاتهام',               'code' => LegalSection::INVESTIGATION_CHAMBER],
                    ['name' => 'الغرفة الاستعجالية',         'code' => LegalSection::URGENT_CHAMBER],
                    ['name' => 'غرفة شؤون الأسرة',           'code' => LegalSection::FAMILY_CHAMBER],
                    ['name' => 'غرفة الأحداث',               'code' => LegalSection::MINORS_CHAMBER],
                    ['name' => 'الغرفة الاجتماعية',          'code' => LegalSection::SOCIAL_CHAMBER],
                    ['name' => 'الغرفة العقارية',            'code' => LegalSection::REAL_ESTATE_CHAMBER],
                    ['name' => 'الغرفة البحرية',             'code' => LegalSection::MARITIME_CHAMBER],
                    ['name' => 'الغرفة التجارية',           'code' => LegalSection::COMMERCIAL_CHAMBER],
                    ['name' => 'محكمة الجنايات الابتدائية',  'code' => LegalSection::CRIMINAL_COURT_FIRST_INSTANCE],
                    ['name' => 'محكمة الجنايات الاستئنافية', 'code' => LegalSection::CRIMINAL_COURT_APPEAL],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | 3. المحكمة العليا
            |--------------------------------------------------------------------------
            */
            elseif ($court->level_id == 3) {
                $rooms = [
                    ['name' => 'الغرفة المدنية (عليا)',        'code' => LegalSection::CIVIL_SUPREME],
                    ['name' => 'الغرفة العقارية (عليا)',      'code' => LegalSection::REAL_ESTATE_SUPREME],
                    ['name' => 'غرفة الأسرة والمواريث',       'code' => LegalSection::FAMILY_INHERITANCE_SUPREME],
                    ['name' => 'الغرفة التجارية والبحرية',    'code' => LegalSection::COMMERCIAL_MARITIME_SUPREME],
                    ['name' => 'الغرفة الاجتماعية (عليا)',    'code' => LegalSection::SOCIAL_SUPREME],
                    ['name' => 'الغرفة الجنائية (عليا)',      'code' => LegalSection::CRIMINAL_SUPREME],
                    ['name' => 'غرفة الجنح والمخالفات',       'code' => LegalSection::MISDEMEANOR_SUPREME],
                    ['name' => 'غرفة الأحوال الشخصية',        'code' => LegalSection::PERSONAL_STATUS_SUPREME],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Insert / Update
            |--------------------------------------------------------------------------
            */
            foreach ($rooms as $room) {
                Courtroom::updateOrCreate(
                    [
                        'court_id' => $court->id,
                        'name'     => $room['name'],
                    ],
                    [
                        'code' => $room['code'],
                    ]
                );
            }
        }
    }
}