<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // التأكد من أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return response()->json(['message' => 'يجب تسجيل الدخول أولاً'], 401);
        }

        $user = Auth::user();

        // فحص ما إذا كانت رتبة المستخدم ضمن الرتب المسموح بها
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'غير مصرح لك بالوصول لهذا القسم'], 403);
        }

        return $next($request);
    }
}