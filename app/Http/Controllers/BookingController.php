<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // 1. الموكل يطلب موعد (الحالة: pending)
    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'booking_date' => 'required|date',
            'meeting_type' => 'required|in:in_person,remote',
            'note' => 'nullable|string',
        ]);

        $booking = Booking::create([
            'client_id' => Auth::id(),
            'consultation_id' => $request->consultation_id,
            'booking_date' => $request->booking_date,
            'meeting_type' => $request->meeting_type,
            'note' => $request->note,
            'status' => 'pending', 
        ]);

        return response()->json(['message' => 'تم إرسال طلب الموعد بنجاح', 'booking' => $booking], 201);
    }

    // 2. المحامي يستجيب (قبول، رفض، إعادة جدولة)
    public function respondToBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // التأكد أن المحامي هو صاحب الاستشارة
        if ($booking->consultation->lawyer_id !== Auth::id()) {
            return response()->json(['message' => 'غير مصرح لك'], 403);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,rescheduled',
            'proposed_date' => 'required_if:status,rescheduled|date',
            'meeting_link' => 'nullable|string',
        ]);

        $booking->status = $request->status;
        
        if ($request->status == 'rescheduled') {
            $booking->proposed_date = $request->proposed_date;
        }
        
        if ($request->has('meeting_link')) {
            $booking->meeting_link = $request->meeting_link;
        }

        $booking->save();

        return response()->json(['message' => 'تم تحديث حالة الموعد', 'booking' => $booking]);
    }

    // 3. الموكل يؤكد الموعد (في حال كان reschedule)
    public function confirmBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->client_id !== Auth::id()) {
            return response()->json(['message' => 'غير مصرح لك'], 403);
        }

        $booking->status = 'confirmed';
        $booking->save();

        return response()->json(['message' => 'تم تأكيد الموعد بنجاح']);
    }

    // 4. دالة عامة لتغيير الحالات (completed, cancelled, no_show)
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:completed,cancelled,no_show',
        ]);

        // التحقق من الصلاحية (المحامي أو الموكل يمكنهم الإلغاء، لكن الإكمال عادة للمحامي)
        $user = Auth::user();
        $isLawyer = $booking->consultation->lawyer_id == $user->id;
        $isClient = $booking->client_id == $user->id;

        if (!$isLawyer && !$isClient) {
            return response()->json(['message' => 'غير مصرح لك'], 403);
        }

        // منطق إضافي لمنع تغيير حالة موعد مكتمل أو مرفوض
        if ($booking->status == 'rejected' || $booking->status == 'completed') {
             return response()->json(['message' => 'لا يمكن تغيير حالة موعد تم إنهاؤه أو رفضه'], 400);
        }

        $booking->status = $request->status;
        $booking->save();

        return response()->json(['message' => 'تم تحديث حالة الموعد إلى ' . $request->status]);
    }
}