<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $fillable = ['consultation_id', 'sender_id', 'receiver_id', 'file_path', 'uploaded_at'];

    public function consultation() {
        return $this->belongsTo(Consultation::class);
    }
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
