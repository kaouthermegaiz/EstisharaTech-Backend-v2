<?php

namespace App\Http\Controllers;
use App\Services\DeadlineService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeadlineController extends Controller
{
    
public function storeDeadline(Request $request, DeadlineService $deadlineService) 
{
    // 1. التحقق من البيانات
    $request->validate([
        'case_id'    => 'required|exists:casefiles,id',
        'type'       => 'required|string',
        'start_date' => 'required|date',
    ]);

    // 2. حساب التاريخ النهائي عبر الـ Service
    $dueDate = $deadlineService->calculateDueDate($request->type, $request->start_date);

    // 3. حفظ الأجل مع إضافة عنوان توضيحي
    $deadline = \App\Models\Deadline::create([
        'case_id'    => $request->case_id,
        'type'       => $request->type,
        'title'      => 'أجل قانوني من نوع: ' . $request->type, // أضفنا العنوان هنا
        'start_date' => $request->start_date,
        'due_date'   => $dueDate,
        'status'     => 'active'
    ]);

    return response()->json([
        'message' => 'تم تفعيل الأجل القانوني بنجاح',
        'due_date' => $dueDate->toDateString(),
        'remaining_days' => now()->diffInDays($dueDate)
    ]);
}
public function getUrgentDeadlines()
{
     $lawyerId = Auth::user()->id;

    // جلب الآجال التي ستنتهي خلال الـ 7 أيام القادمة 
    // والمنتمية لقضايا هذا المحامي فقط
    $urgentDeadlines = \App\Models\Deadline::where('status', 'active')
        ->whereHas('casefile', function($query) use ($lawyerId) {
            $query->where('lawyer_id', $lawyerId);
        })
        ->whereBetween('due_date', [now(), now()->addDays(7)])
        ->orderBy('due_date', 'asc')
        ->get();

    return response()->json([
        'status' => 'success',
        'count' => $urgentDeadlines->count(),
        'data' => $urgentDeadlines
    ]);
}

public function markAsCompleted($id)
{
    $deadline = \App\Models\Deadline::findOrFail($id);
    
    // التحقق من أن المحامي هو صاحب القضية المرتبطة بهذا الأجل
    if ($deadline->casefile->lawyer_id !== Auth::user()->id) {
        return response()->json(['message' => 'غير مصرح لك بتعديل هذا الأجل'], 403);
    }

    $deadline->update(['status' => 'completed']);

    return response()->json(['message' => 'تم تحديث حالة الأجل إلى مكتمل، وتوقف التنبيه']);
}
}
