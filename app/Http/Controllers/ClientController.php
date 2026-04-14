<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;

class ClientController extends Controller
{
    public function index()
    {
        
        $consultations = Consultation::where('client_id', Auth::id())
            ->with('lawyer.user') 
            ->latest() 
            ->get();

        return response()->json($consultations);
    }
}
