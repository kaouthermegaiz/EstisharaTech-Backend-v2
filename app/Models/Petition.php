<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'case_id',
        'lawyer_id',
        'template_id', 
        'opponent_name',
        'generated_content',
        'status',
    ];

    
    public function casefile()
    {
        return $this->belongsTo(Casefile::class, 'case_id');
    }
}