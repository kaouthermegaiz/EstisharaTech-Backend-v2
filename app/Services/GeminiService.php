<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;

class GeminiService
{
    public function generateLegalResponse(string $prompt)
    {
        // نستخدم الموديل الذي أثبت نجاحه
        $result = Gemini::generativeModel('gemini-2.5-flash')
            ->generateContent($prompt);

        return $result->text();
    }
}