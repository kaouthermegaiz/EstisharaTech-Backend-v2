<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Casefile extends Model
{
    protected $fillable = ['title', 'client_id', 'lawyer_id', 'courtroom_id', 'description', 'status'];

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'user_id');
    }

    public function courtroom(): BelongsTo
    {
        return $this->belongsTo(Courtroom::class);
    }

    
    public function expenses(): HasMany
    {
        return $this->hasMany(CaseExpense::class, 'case_id');
    }

    
    public function sessions(): HasMany
    {
        return $this->hasMany(CourtSession::class, 'case_id');
    }

    
    public function petitions(): HasMany
    {
        return $this->hasMany(Petition::class, 'case_id');
    }
}
