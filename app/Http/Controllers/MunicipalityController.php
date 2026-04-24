<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MunicipalityController extends Controller
{
    public function getMunicipalities(): JsonResponse
{
    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // تأكد من تحميل العلاقة 'client' أولاً، ثم جلب الولاية منها
    $user = Auth::user()->load('client');
    
    // إذا لم يجد المستخدم بروفايل 'client'، لن نستطيع جلب البلديات
    if (!$user->client) {
        return response()->json([], 200);
    }

    $wilayaId = $user->client->wilaya_id;

    // جلب البلديات بناءً على ولاية الموكل
    $municipalities = Municipality::where('wilaya_id', $wilayaId)->get();

    return response()->json($municipalities);
}
}