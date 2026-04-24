<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;

class LawyerController extends Controller
{
    public function index()
    {
        
        $lawyerId = Auth::id(); 
        $consultations = Consultation::where('lawyer_id', $lawyerId)
            ->with('client.user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($consultations);
    }

// LawyerController.php

public function updateProfile(Request $request)
{
    $user = Auth::user();
    $lawyer = $user->lawyer;

    $validatedData = $request->validate([
        'name' => 'sometimes|string|max:255',
        'law_firm' => 'sometimes|nullable|string|max:255',
        'contact' => 'sometimes|string',
        'bio' => 'sometimes|nullable|string',
        'wilaya_id' => 'sometimes|exists:wilayas,id',
        'grade' => 'sometimes|string',
    ]);

    // 1. تحديث بيانات المستخدم الأساسية إذا وجدت
    if ($request->has('name')) {
        $user->update(['name' => $request->name]);
    }

    // 2. تحديث بيانات المحامي
    $lawyer->update($request->only([
        'law_firm', 'contact', 'bio', 'wilaya_id', 'grade'
    ]));

    // إعادة اليوزر مع العلاقات الجديدة لتحديث الـ State في الفرونت
    $updatedUser = User::with(['lawyer.wilaya', 'wilaya'])->find($user->id);

    return response()->json([
        'message' => 'تم تحديث الملف الشخصي بنجاح',
        'user' => $updatedUser
    ]);
}
    // LawyerController.php

public function search(Request $request)
{
    $name = $request->query('name');
    $wilaya = $request->query('wilaya');
    
    $lawyers = \App\Models\User::where('role', 2)
        ->where(function($mainQuery) use ($name, $wilaya) {
            // البحث بالاسم في جدول users
            if ($name) {
                $mainQuery->where('name', 'LIKE', "%{$name}%");
            }
            
            // أو البحث بالولاية (عن طريق العلاقة)
            if ($wilaya) {
                $mainQuery->orWhereHas('lawyer.wilaya', function ($query) use ($wilaya) {
                    $query->where('name', 'LIKE', "%{$wilaya}%");
                });
            }
        })
        ->with(['lawyer.wilaya']) 
        ->get();

    if ($lawyers->isEmpty()) {
        return response()->json([], 200); // إرجاع مصفوفة فارغة أفضل للفرونت-أند
    }

    return response()->json($lawyers);
}

    public function dashboard()
    {
        $lawyerId = Auth::user()->id;

        // 1. إجمالي القضايا
        $totalCases = \App\Models\Casefile::where('lawyer_id', $lawyerId)->count();

        // 2. جلسات اليوم (جلسات مسجلة لتاريخ اليوم)
        $todaySessions = \App\Models\CourtSession::whereHas('casefile', function($q) use($lawyerId) {
            $q->where('lawyer_id', $lawyerId);
        })->whereDate('session_date', now()->toDateString())->count();

        // 3. استشارات معلقة (pending)
        $pendingConsultations = \App\Models\Consultation::where('lawyer_id', $lawyerId)
                            ->where('status', 'pending')->count();

        // 4. زبائن فريدون (من جدول القضايا)
        $totalClients = \App\Models\Casefile::where('lawyer_id', $lawyerId)
                        ->distinct('client_id')->count('client_id');

        return response()->json([
            'total_cases'           => $totalCases,
            'today_sessions'        => $todaySessions,
            'pending_consultations' => $pendingConsultations,
            'total_clients'         => $totalClients
        ]);
    }

    
   
public function getMyConsultedClients()
{
    $clients = Consultation::where('lawyer_id', Auth::id())
        ->whereIn('status', ['accepted', 'completed'])
        ->with('client.user')
        ->get()
        ->pluck('client')
        ->unique('user_id')
        ->values(); // مهم

    return response()->json($clients);
}
}
