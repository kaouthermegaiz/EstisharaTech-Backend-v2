<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // دالة إنشاء الموعد (للمحامي)
   public function store(Request $request)
{
    $request->validate([
        'consultation_id' => 'required|exists:consultations,id',
        'booking_date' => 'required|date',
    ]);

    // التأكد أن الموكل هو صاحب الاستشارة وأنها مقبولة
    $consultation = Consultation::where('id', $request->consultation_id)
        ->where('client_id', Auth::id()) // التأكد أن الموكل هو من يملكها
        ->where('status', 'accepted')
        ->firstOrFail();

    $booking = Booking::create([
        'client_id' => Auth::id(),
        'consultation_id' => $consultation->id,
        'booking_date' => $request->booking_date,
        'status' => 'confirmed',
    ]);

    return response()->json(['message' => 'تم الحجز بنجاح', 'booking' => $booking], 201);
}
    // عرض مواعيد المحامي
    public function lawyerBookings()
    {
        $bookings = Booking::whereHas('consultation', function($query) {
            $query->where('lawyer_id', Auth::id());
        })->with(['client.user', 'consultation'])->latest()->get();

        return response()->json($bookings);
    }

    // عرض مواعيد الزبون
    public function clientBookings()
    {
        $bookings = Booking::where('client_id', Auth::id())
            ->with(['consultation.lawyer.user'])
            ->latest()
            ->get();

        return response()->json($bookings);
    }
}