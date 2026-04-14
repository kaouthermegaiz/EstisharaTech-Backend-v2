<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = ['user_id', 'wilaya_id', 'phone_number'];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function casefiles(): HasMany
    {
        return $this->hasMany(Casefile::class, 'client_id', 'user_id');
    }

    
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'client_id', 'user_id');
    }

    
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'client_id', 'user_id');
    }
}
