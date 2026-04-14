<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lawyer;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:2,3', // 2 = محامي, 3 = زبون
            'phone_number' => 'required_if:role,2,3',

            // الحقول المشتركة
            'wilaya_id' => 'required|exists:wilayas,id',

            // الحقول الخاصة بالمحامي
            'license_number' => 'required_if:role,2|unique:lawyers',
            'grade' => 'required_if:role,2',
            'law_firm' => 'nullable|string|max:255',
            
        ]);

        return DB::transaction(function () use ($request) {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($user->role == 2) { // محامي
                Lawyer::create([
                    'user_id' => $user->id,
                    'license_number' => $request->license_number,
                    'wilaya_id' => $request->wilaya_id,
                    'law_firm' => $request->law_firm,
                    'grade' => $request->grade, 
                    'contact' => $request->phone_number,
                ]);
            } else { // زبون
                Client::create([
                    'user_id' => $user->id,
                    'wilaya_id' => $request->wilaya_id,
                    'phone_number' => $request->phone_number,
                ]);
            }

            Auth::login($user);
            $user = User::with(['lawyer.wilaya', 'wilaya'])->find(Auth::id());
            return response()->json(['message' => 'تم التسجيل بنجاح', 'user' => $user]);
        });
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'بيانات الدخول غير صحيحة'
            ], 401);
        }

        $user = User::with(['lawyer.wilaya', 'wilaya'])->find(Auth::id());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function logout(Request $request)
    {
    Auth::guard('web')->logout(); 
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
    }
}
