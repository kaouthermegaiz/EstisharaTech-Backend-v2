<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourtSessionController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'case_id' => 'required|exists:casefiles,id',
        'session_date' => 'required|date',
        'courtroom_id' => 'nullable|exists:courtrooms,id',
        'notes' => 'nullable|string',
    ]);

    // حفظ الجلسة
    $session = \App\Models\CourtSession::create($validated);

    // جلب المستخدم الحالي (المحامي) لإرسال التنبيه له
    $user = Auth::user();

    if ($user) {
        $user->notify(new \App\Notifications\DeadlineReminder([
            'title' => 'جلسة محكمة جديدة رقم: ' . $session->id,
            'due_date' => $session->session_date,
            'type' => 'court_session'
        ]));
    }

    return response()->json([
        'status' => 'success',
        'message' => 'تم تسجيل الجلسة بنجاح وإضافتها لجدول المواعيد',
        'data' => $session
    ]);
}
}
