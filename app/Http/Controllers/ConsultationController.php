<?php

namespace App\Http\Controllers;

use App\Models\{Consultation, Casefile};
use App\Services\Case\CaseConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log, DB};
use Illuminate\Validation\Rule; // مهم لاستخدام التحقق المتقدم
use Exception;

class ConsultationController extends Controller
{
    protected $conversionService;

    public function __construct(CaseConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }

    /* =========================
        1. STORE CONSULTATION
    ==========================*/
    public function store(Request $request)
    {
        // تحقق مما يراه النظام
Log::info('Full User Object: ' . json_encode(Auth::user()));

// إذا كان لديك علاقة، افحصها أيضاً
if (Auth::user()->client) {
    Log::info('Client Data: ' . json_encode(Auth::user()->client));
} else {
    Log::info('No Client profile found for this user');
}
        // الحصول على ولاية الموكل الحالي لفلترة البلديات
        
        // جرب الوصول عبر العلاقة (بافتراض أن لديك دالة client في نموذج User)
    $userWilayaId = Auth::user()->client->wilaya_id; 

        // أضف هذا السطر للتصحيح فقط
\Log::info('User Wilaya ID: ' . $userWilayaId); 
\Log::info('Request Location: ' . $request->location);
        $request->validate([
            'lawyer_id'    => 'required|exists:lawyers,user_id',
            'subject'      => 'required|string|max:255',
            'description'  => 'required|string',
            'consul_date'  => 'required|date|after_or_equal:today',
            'goal'         => 'required|in:consultation,file_case,defense',
            
            // التحقق: البلدية يجب أن تكون موجودة في جدول البلديات وتابعة لولاية الموكل
            'location'     => [
                'required', 
                'string', 
                Rule::exists('municipalities', 'name')->where('wilaya_id', $userWilayaId)
            ],
            
            'legal_status' => 'required|in:not_started,needs_legal_action,in_court',
        ]);

        $consultation = Consultation::create([
            'client_id'      => Auth::id(),
            'lawyer_id'      => $request->lawyer_id,
            'subject'        => $request->subject,
            'description'    => $request->description,
            'consul_date'    => $request->consul_date,
            'location'       => $request->location, // ستخزن اسم البلدية
            'legal_status'   => $request->legal_status,
            'goal'           => $request->goal,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return response()->json([
            'message' => 'تم إرسال طلب الاستشارة بنجاح',
            'consultation' => $consultation
        ], 201);
    }

    /* =========================
        2. SHOW CONSULTATION
    ==========================*/
    public function show($id)
    {
        $user = Auth::user();

        $consultation = Consultation::where('id', $id)
            ->where(function ($q) use ($user) {
                $q->where('client_id', $user->id)
                  ->orWhere('lawyer_id', $user->id);
            })
            ->with(['lawyer.user', 'client.user', 'messages'])
            ->firstOrFail();

        return response()->json($consultation);
    }

    /* =========================
        3. UPDATE STATUS + AUTO CONVERSION
    ==========================*/
    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $consultation = Consultation::findOrFail($id);

            if ($consultation->lawyer_id !== Auth::id()) {
                return response()->json(['error' => 'غير مصرح لك'], 403);
            }

            $request->validate([
                'status' => 'required|in:pending,accepted,rejected,closed'
            ]);

            $allowedTransitions = [
                'pending' => ['accepted', 'rejected'],
                'accepted' => ['closed'],
            ];

            $current = $consultation->status;
            $new = $request->status;

            if (!in_array($new, $allowedTransitions[$current] ?? [])) {
                return response()->json(['error' => 'تغيير الحالة غير مسموح'], 422);
            }

            $consultation->status = $new;
            $consultation->save();

            $case = null;
            $consultation->refresh();

            if (
                $new === 'accepted' &&
                $this->isEligibleForConversion($consultation) &&
                !$consultation->converted_to_case
            ) {
                $case = $this->conversionService->handleAutoCaseConversion($consultation);
            }

            DB::commit();

            return response()->json([
                'message' => $case
                    ? 'تم قبول الاستشارة وتحويلها إلى قضية بنجاح'
                    : 'تم تحديث الحالة بنجاح',
                'case' => $case ? $case->load(['courtroom.court']) : null,
                'consultation' => $consultation
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Conversion Failed: " . $e->getMessage());
            return response()->json([
                'error' => 'خطأ أثناء المعالجة: ' . $e->getMessage()
            ], 422);
        }
    }

    /* =========================
        PREVIEW AI
    ==========================*/
    public function previewConversion($id)
    {
        try {
            $consultation = Consultation::findOrFail($id);

            if ($consultation->lawyer_id !== Auth::id()) {
                return response()->json(['error' => 'غير مصرح'], 403);
            }

            $preview = $this->conversionService->previewConversion($consultation);

            return response()->json([
                'message' => 'تحليل الذكاء الاصطناعي',
                'preview' => $preview
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /* =========================
        4. MANUAL CONVERSION
    ==========================*/
    public function convertToCase($id)
    {
        DB::beginTransaction();

        try {
            $consultation = Consultation::findOrFail($id);

            if ($consultation->lawyer_id !== Auth::id()) {
                return response()->json(['error' => 'غير مصرح'], 403);
            }

            if ($consultation->status !== 'accepted') {
                return response()->json(['error' => 'يجب قبول الاستشارة أولاً'], 422);
            }

            if ($consultation->converted_to_case) {
                return response()->json(['error' => 'تم التحويل مسبقاً'], 422);
            }

            $consultation->refresh();

            $case = $this->conversionService->handleAutoCaseConversion($consultation);

            DB::commit();

            return response()->json([
                'message' => 'تم التحويل اليدوي بنجاح',
                'case' => $case->load(['courtroom.court']),
                'consultation' => $consultation
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /* =========================
        HELPERS
    ==========================*/
    private function isEligibleForConversion($consultation)
    {
        return in_array($consultation->goal, ['file_case', 'defense']);
    }
}