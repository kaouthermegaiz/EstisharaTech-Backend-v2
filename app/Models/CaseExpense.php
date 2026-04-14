<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseExpense extends Model
{
    protected $fillable = ['case_id', 'type', 'amount', 'description'];

    public function casefile() {
    return $this->belongsTo(Casefile::class, 'case_id');
    }
}
