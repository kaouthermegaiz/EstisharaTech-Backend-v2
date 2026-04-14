<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lawyer_id' => 'required|exists:lawyers,user_id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'consul_date' => 'required|date',
        ]);

        $consultation = \App\Models\Consultation::create([
            'client_id' => Auth::id(), // نأخذه تلقائياً من التوكن
            'lawyer_id' => $request->lawyer_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'consul_date' => $request->consul_date,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return response()->json([
            'message' => 'تم إرسال طلب الاستشارة بنجاح',
            'consultation' => $consultation
        ], 201);
    }

   public function show($id)
{
    $user = Auth::user();
    $consultation = Consultation::where('id', $id)
        ->where(function($query) use ($user) {
            $query->where('client_id', $user->id)
                  ->orWhere('lawyer_id', $user->id);
        })
        ->with(['lawyer.user', 'client.user']) // تأكد من جلب بيانات المحامي للموكل
        ->firstOrFail();

    return response()->json($consultation);
}
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // البحث عن الاستشارة والتأكد أنها تخص المحامي المسجل دخوله حالياً
        $consultation = \App\Models\Consultation::where('id', $id)
        ->where('lawyer_id', Auth::id())
        ->firstOrFail();

        $consultation->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'تم تحديث حالة الاستشارة بنجاح',
            'consultation' => $consultation
        ]);
    }
}
