<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casefile;
use Illuminate\Support\Facades\Auth;

class CasefileController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,user_id',
            'courtroom_id' => 'required|exists:courtrooms,id',
            'description' => 'nullable|string',
            'status' => 'required|string', // مثلاً: "جديدة" أو "قيد الدراسة"
        ]);

        $case = Casefile::create([
            'title' => $validated['title'],
            'client_id' => $validated['client_id'],
            'lawyer_id' => Auth::id(), // المحامي المسجل حالياً
            'courtroom_id' => $validated['courtroom_id'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'تم تسجيل القضية بنجاح',
            'case' => $case
        ], 201);
    }
}