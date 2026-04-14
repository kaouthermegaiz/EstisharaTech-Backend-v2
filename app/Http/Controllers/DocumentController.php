<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller {
    public function upload(Request $request) {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'receiver_id' => 'required|exists:users,id',
            'file' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        $path = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'consultation_id' => $request->consultation_id, //
            'sender_id' => Auth::id(), //
            'receiver_id' => $request->receiver_id, //
            'file_path' => $path,
            'file_type' => $request->file('file')->getClientOriginalExtension(),
            'uploaded_at' => now()
        ]);

        return response()->json(['message' => 'تم رفع الملف بنجاح', 'document' => $document]);
    }
}