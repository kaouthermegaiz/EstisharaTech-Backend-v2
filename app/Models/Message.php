<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'sender_id',
        'receiver_id',
        'message',
        'file_path', 
        'file_type', 
    ];

    // العلاقة مع المستخدم (المرسل)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // العلاقة مع الاستشارة المرتبطة بها
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}