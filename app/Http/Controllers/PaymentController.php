<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function store(Request $request) {
    $validated = $request->validate([
        'consultation_id' => 'required|exists:consultations,id',
        'amount' => 'required|numeric',
        'method' => 'required|string', // بريدي موب، نقدي، وصل بنكي
        'transaction_reference' => 'nullable|string',
    ]);

    $payment = \App\Models\Payment::create([
        'consultation_id' => $validated['consultation_id'],
        'amount' => $validated['amount'],
        'method' => $validated['method'],
        'status' => 'pending', // بانتظار تأكيد المحامي
        'payment_date' => now(),
        'transaction_reference' => $validated['transaction_reference']
    ]);

    return response()->json(['message' => 'تم تسجيل عملية الدفع بنجاح بانتظار التأكيد']);
}

// دالة للمحامي لتأكيد استلام المبلغ
public function verify($id) {
    $payment = \App\Models\Payment::findOrFail($id);
    $payment->update(['verification_status' => true, 'status' => 'completed']);
    
    return response()->json(['message' => 'تم تأكيد الدفع وتحديث حالة الاستشارة']);
}
}
