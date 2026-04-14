<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courtroom extends Model
{
    public function court() { return $this->belongsTo(Court::class); }
    public function cases() { return $this->hasMany(Casefile::class); }
}
