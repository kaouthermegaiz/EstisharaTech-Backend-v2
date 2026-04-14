<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $messageData;

    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    // تحديد قناة التخزين (قاعدة البيانات)
    public function via($notifiable)
    {
        return ['database'];
    }

    // البيانات التي ستخزن في قاعدة البيانات
    public function toArray($notifiable)
    {
        return [
            'message_id' => $this->messageData->id,
            'consultation_id' => $this->messageData->consultation_id,
            'sender_name' => $this->messageData->sender->name,
            'text' => 'لديك رسالة جديدة بخصوص الاستشارة رقم ' . $this->messageData->consultation_id,
            'type' => 'chat_message'
        ];
    }
}