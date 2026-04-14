<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lawyer extends Model
{
    
    protected $primaryKey = 'user_id';
    public $incrementing = false; 

    protected $fillable = [
        'user_id',
        'license_number',
        'wilaya_id',
        'grade',
        'law_firm',
        'contact',
        'bio',
        'is_professionally_verified',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wilaya(): BelongsTo
    {
        
        return $this->belongsTo(Wilaya::class, 'wilaya_id');
    }

    
    public function casefiles(): HasMany
    {
        return $this->hasMany(Casefile::class, 'lawyer_id', 'user_id');
    }

    
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class, 'lawyer_id', 'user_id');
    }

   
    public function tasks(): HasMany
    {
        return $this->hasMany(LawyerTask::class, 'lawyer_id', 'user_id');
    }

    
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'lawyer_id', 'user_id');
    }

    
    public function petitions(): HasMany
    {
        return $this->hasMany(Petition::class, 'lawyer_id', 'user_id');
    }
}
