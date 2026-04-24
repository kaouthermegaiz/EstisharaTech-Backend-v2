<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    // الحقول التي تسمح بمرور البيانات من الـ Request
    protected $fillable = [
        'client_id', 'consultation_id', 'booking_date', 'status',
        'meeting_type', 'meeting_link', 'location', 'note', 'proposed_date'
    ];

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'user_id');
    }
}