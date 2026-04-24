<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    protected $fillable = ['level_id', 'wilaya_id', 'name', 'location'];
    public function level() { return $this->belongsTo(CourtLevel::class, 'level_id'); }
    public function courtrooms() { 
        return $this->hasMany(Courtroom::class, 'court_id'); 
    }
}
