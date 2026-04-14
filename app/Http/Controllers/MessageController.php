<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Consultation;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
{
    $request->validate([
        'consultation_id' => 'required|exists:consultations,id',
        'message' => 'required|string',
    ]);

    $user = Auth::user();
    
    // 1. جلب بيانات الاستشارة
    $consultation = Consultation::findOrFail($request->consultation_id);

    // 2. التحقق من الهوية: هل المستخدم الحالي هو المحامي أو الزبون الخاص بهذه الاستشارة؟
    if ($user->id !== $consultation->lawyer_id && $user->id !== $consultation->client_id) {
        return response()->json(['message' => 'غير مصرح لك بإرسال رسائل في هذه الاستشارة'], 403);
    }

    // 3. التحقق من الحالة (يجب أن تكون مقبولة)
    if ($consultation->status !== 'accepted') {
        return response()->json(['message' => 'لا يمكن المراسلة في استشارة غير مقبولة'], 403);
    }

    // 4. تحديد المستلم تلقائياً
    $receiver_id = ($user->id === $consultation->lawyer_id) 
                    ? $consultation->client_id 
                    : $consultation->lawyer_id;

    $file_path = null;
    if ($request->hasFile('file')) {
        // تخزين الملف في مجلد public/attachments
        $file_path = $request->file('file')->store('attachments', 'public');
    }

    // 5. حفظ الرسالة
    $newMessage = Message::create([
        'consultation_id' => $request->consultation_id,
        'sender_id' => $user->id,
        'receiver_id' => $receiver_id,
        'message' => $request->message,
        'file_path' => $file_path,
        'file_type' => $request->file('file')?->getClientOriginalExtension(),
        
    ]);
    $receiver = User::find($receiver_id);
    $receiver->notify(new NewMessageNotification($newMessage));

    return response()->json([
        'status' => 'success',
        'message' => 'تم إرسال الرسالة بنجاح',
        'data' => $newMessage
    ]);
}



// 1. جلب المناقشات المهنية فقط
public function proDiscussions()
{
    $userId = Auth::id();

    $messages = Message::whereNull('consultation_id') // شرط المناقشة المهنية
        ->where(function($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        })
        ->with(['sender:id,name', 'receiver:id,name'])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($messages);
}

// 2. إرسال رسالة إلى زميل محامي
public function sendProMessage(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
    ]);

    $file_path = null;
    if ($request->hasFile('file')) {
        $file_path = $request->file('file')->store('pro_attachments', 'public');
    }

    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'consultation_id' => null, // نتركها فارغة لتمييزها كرسالة مهنية
        'message' => $request->message,
        'file_path' => $file_path,
        'file_type' => $request->file('file')?->getClientOriginalExtension(),
    ]);

    return response()->json(['message' => 'تم إرسال الرسالة المهنية بنجاح', 'data' => $message]);
}
    
}