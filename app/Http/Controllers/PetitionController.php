<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use App\Models\PetitionTemplate;
use App\Models\Casefile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    public function generate(Request $request)
    {
        // 1. جلب بيانات القضية والقالب
        $case = Casefile::with(['client', 'courtroom.court', 'lawyer'])->findOrFail($request->case_id);
        $template = PetitionTemplate::findOrFail($request->template_id);

        // 2. تجهيز مصفوفة البيانات (Mapping)
        //هنا نربط "الوسم" الموجود في النص بالبيانات الحقيقية في قاعدة بيانات
        $data = [
            '{{court_name}}'       => $case->courtroom->court->name ?? '........',
            '{{courtroom_name}}'   => $case->courtroom->name ?? '........',
            '{{client_full_name}}' => $case->client->full_name ?? '........',
            '{{opponent_full_name}}'=> $request->opponent_name, // نأخذها من الفورم
            '{{lawyer_name}}'      => $case->lawyer->full_name ?? '........',
            '{{case_number}}'      => $case->id,
            '{{current_date}}'     => date('Y-m-d'),
        ];

        // 3. عملية الدمج السحرية
        $finalContent = str_replace(
            array_keys($data), 
            array_values($data), 
            $template->content
        );

        // 4. حفظ العريضة النهائية في جدول Petitions
        $petition = Petition::create([
        'case_id' => $request->case_id,
        'template_id' => $request->template_id,
        'lawyer_id' => Auth::id(), 
        'opponent_name' => $request->opponent_name,
        'generated_content' => $finalContent, 
        'status' => 'draft',
    ]);

        return response()->json([
            'message' => 'تم توليد العريضة بنجاح',
            'petition' => $petition
        ]);
    }

    public function show($id)
{
    $petition = Petition::findOrFail($id);
    return response()->json([
        'title' => $petition->template->title,
        'content' => $petition->final_content
    ]);
}
}