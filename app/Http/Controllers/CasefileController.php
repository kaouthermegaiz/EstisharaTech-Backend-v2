<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casefile;
use Illuminate\Support\Facades\Auth;

class CasefileController extends Controller
{
    /**
     * عرض قائمة القضايا مع إمكانية الفلترة حسب القسم
     */
    public function index(Request $request)
{
    $query = Casefile::where('lawyer_id', Auth::id())
        ->with(['client.user', 'courtroom']);

    
    if ($request->filled('courtroom_id')) {
    $query->where('courtroom_id', $request->courtroom_id);
    } 
    
    elseif ($request->has('section')) {
        $query->whereHas('courtroom', function($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->section . '%');
        });
    }

    $cases = $query->latest()->get(); 
    return response()->json($cases);
}

    /**
     * تسجيل قضية جديدة يدوياً
     */
    public function store(Request $request)
    {
        // استخدام required_without لضمان وجود هوية للزبون (إما ID أو اسم)
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,user_id',
            'external_client_name' => 'required_without:client_id',
            'external_client_phone' => 'required_without:client_id',
            'courtroom_id' => 'required|exists:courtrooms,id',
            'description'  => 'nullable|string',
            'status'       => 'required|string', 
        ]);

        $caseData = [
        'title' => $request->title,
        'lawyer_id' => Auth::id(), // المحامي دائماً موجود
        'courtroom_id' => $request->courtroom_id,
        'description' => $request->description,
        'status' => 'مفتوحة',
        ];

        if ($request->filled('client_id')) {
        $caseData['client_id'] = $request->client_id;
        } else {
        $caseData['external_client_name'] = $request->external_client_name;
        $caseData['external_client_phone'] = $request->external_client_phone;
        }
        // إنشاء القضية
        $case = Casefile::create($caseData);

        return response()->json([
        'message' => 'تم تسجيل القضية بنجاح',
        'case'    => $case->load(['client', 'courtroom']) // تأكد من أن أسماء العلاقات مطابقة لما هو موجود في Model
        ], 201);
    }
    /**
     * عرض تفاصيل قضية محددة
     */
    public function show($id)
    {
        $case = Casefile::with(['client.user', 'courtroom.court'])->findOrFail($id);
        
        // حماية الأمان: منع محامي من رؤية قضايا محامي آخر
        if ($case->lawyer_id !== Auth::id()) {
            return response()->json(['error' => 'غير مصرح لك بالوصول لهذه القضية'], 403);
        }

        return response()->json($case);
    }
}