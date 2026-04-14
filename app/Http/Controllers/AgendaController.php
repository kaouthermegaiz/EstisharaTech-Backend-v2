<?php

namespace App\Http\Controllers;

use App\Models\CourtSession;
use App\Models\LawyerTask;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller {
    public function getMyAgenda() {
    $lawyerId = Auth::user()->id;

    // جلب الجلسات
    $sessions = CourtSession::whereHas('casefile', fn($q) => $q->where('lawyer_id', $lawyerId))
        ->get()
        ->map(fn($item) => [
            'id' => $item->id,
            'title' => "جلسة: " . ($item->casefile->title ?? 'قضية غير محددة'),
            'start' => $item->session_date,
            'type' => 'court_session',
            'color' => '#B2967D' // Cocoa
        ]);

    // جلب المهام
    $tasks = LawyerTask::where('lawyer_id', $lawyerId)
        ->get()
        ->map(fn($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->start_at,
            'end' => $item->end_at,
            'type' => 'task',
            'color' => '#D4AF37' // Gold
        ]);

    return response()->json($sessions->concat($tasks));
}
}