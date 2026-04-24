<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    protected $fillable = ['client_id', 'lawyer_id', 'consul_date', 'status', 'payment_status', 'subject', 'description','location','legal_status','goal','converted_to_case'];

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'user_id');
    }

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }

    
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    
    public function messages()
{
    return $this->hasMany(Message::class, 'consultation_id');
}

    
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
