<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtSession extends Model
{
    protected $fillable = ['case_id', 'courtroom_id', 'session_date', 'is_delayed', 'notes'];

    public function casefile() {
        return $this->belongsTo(Casefile::class, 'case_id');
    }
    protected $table = 'court_sessions';
}
