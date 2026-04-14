<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Http\Controllers\{
    AuthController, LawyerController, ClientController,
    ConsultationController, BookingController, DeadlineController,
    DocumentController, MessageController, PetitionController,
    AgendaController, CasefileController, PaymentController
};

/*
|--------------------------------------------------------------------------
| API Routes - مشروع استشاراتك (Estisharatuk)
|--------------------------------------------------------------------------
*/

// 1. المسارات العامة
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/wilayas', function () {
    return \App\Models\Wilaya::select('id', 'name')->get();
});

// 2. المسارات المحمية
Route::middleware('auth:sanctum')->group(function () {

    // البحث العام عن المحامين
    Route::get('/lawyer/search', [LawyerController::class, 'search']);

    // --- مسارات خاصة بالأدمن (Role 1) ---
    Route::middleware('role:1')->prefix('admin')->group(function () {
        Route::get('/dashboard', function() { 
            return response()->json(['message' => 'Welcome Admin']); 
        });
    });

    // --- مسارات خاصة بالمحامي (Role 2) ---
    Route::middleware('role:2')->prefix('lawyer')->group(function () {
        Route::get('/dashboard', [LawyerController::class, 'dashboard']);
        Route::put('/profile/update', [LawyerController::class, 'updateProfile']);
        Route::get('/my-cases', [LawyerController::class, 'index']);
        Route::get('/agenda', [AgendaController::class, 'getMyAgenda']);
        Route::get('/my-bookings', [BookingController::class, 'lawyerBookings']);
        Route::get('/consultations', [LawyerController::class, 'index']);
        Route::get('/consultations/{id}', [ConsultationController::class, 'show']);
        Route::patch('/consultations/{id}/status', [ConsultationController::class, 'updateStatus']);
        Route::post('/cases', [CasefileController::class, 'store']);
        Route::get('/judicial-structure', function (Request $request) {
            $user = $request->user();
    
            // جلب ولاية المحامي من جدول المحامين المرتبط به
            $lawyerWilayaId = $user->lawyer ? $user->lawyer->wilaya_id : null;

            $query = \App\Models\Court::query();

            if ($lawyerWilayaId) {
                $query->where(function($q) use ($lawyerWilayaId) {
                $q->where('wilaya_id', $lawyerWilayaId) // محاكم ولايته
                ->orWhereNull('wilaya_id');           // المحكمة العليا
            });
            } else {
            $query->whereNull('wilaya_id'); 
            }

            return $query->with(['level', 'courtrooms' => function($q) {
                $q->withCount('cases'); 
                }])->get();
        });
        Route::get('/my-consulted-clients', [LawyerController::class, 'getMyConsultedClients']);
        Route::get('/pro-discussions', [MessageController::class, 'proDiscussions']);
        Route::post('/send-pro-message', [MessageController::class, 'sendProMessage']);
        // إدارة الآجال القانونية
        Route::prefix('deadlines')->group(function () {
            Route::post('/store', [DeadlineController::class, 'storeDeadline']);
            Route::get('/urgent', [DeadlineController::class, 'getUrgentDeadlines']);
            Route::patch('/{id}/complete', [DeadlineController::class, 'markAsCompleted']);
        });

        // العرائض
        Route::post('/petitions/generate', [PetitionController::class, 'generate']);
        Route::get('/petitions/{id}/preview', [PetitionController::class, 'show']);

        // المالية (خاص بالمحامي)
        Route::patch('/payments/{id}/verify', [PaymentController::class, 'verify']);
        Route::post('/expenses/store', function(Request $request) {
            $data = $request->validate([
                'case_id' => 'required|exists:casefiles,id',
                'type' => 'required|string',
                'amount' => 'required|numeric',
            ]);
            return \App\Models\CaseExpense::create($data);
        });
    });

    // --- مسارات خاصة بالزبون (Role 3) ---
    Route::middleware('role:3')->prefix('client')->group(function () {
        Route::get('/my-consultations', [ClientController::class, 'index']);
        Route::post('/consultations', [ConsultationController::class, 'store']);
        Route::get('/my-consultations', [ClientController::class, 'index']);
        Route::get('/consultations/{id}', [ConsultationController::class, 'show']);
        Route::get('/my-bookings', [BookingController::class, 'clientBookings']);
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::post('/payments/store', [PaymentController::class, 'store']); // تسجيل دفع استشارة
    });

    // --- الخدمات المشتركة ---
    Route::prefix('messages')->group(function () {
        Route::post('/send', [MessageController::class, 'sendMessage']);
        Route::get('/history/{consultationId}', [MessageController::class, 'getMessages']);
    });

    Route::prefix('shared')->group(function () {
        Route::post('/upload-document', [DocumentController::class, 'upload']);
        Route::get('/petition-templates/{catId}', [PetitionController::class, 'getTemplates']);
        Route::post('/save-petition', [PetitionController::class, 'store']);
    });

    // --- نظام التنبيهات ---
    Route::prefix('notifications')->group(function () {
        Route::get('/', function () {
            return response()->json(Auth::user()->unreadNotifications);
        });
        Route::post('/{id}/read', function ($id) {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $notification->markAsRead();
            return response()->json(['message' => 'تم التحديث']);
        });
    });
});