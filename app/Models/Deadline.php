<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    
    protected $fillable = [
        'case_id', 
        'type', 
        'title', 
        'start_date', 
        'due_date', 
        'status'
    ];

    
    public function casefile()
    {
        return $this->belongsTo(Casefile::class, 'case_id');
    }
}