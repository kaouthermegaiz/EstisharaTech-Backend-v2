<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LawyerTask extends Model
{
    protected $fillable = ['lawyer_id', 'case_id', 'title', 'description', 'start_at', 'end_at', 'task_type', 'priority'];
}
