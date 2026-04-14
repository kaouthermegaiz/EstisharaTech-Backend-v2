<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeadlineReminder extends Notification
{
    use Queueable;

    
    protected $details;

    /**
     * Create a new notification instance.
     */
    public function __construct($details)
    {
        
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        
        return [
            'title' => $this->details['title'],
            'due_date' => $this->details['due_date'],
            'type' => $this->details['type'], // 'session' أو 'task'
            'message' => 'تذكير: لديك ' . $this->details['title'] . ' بتاريخ ' . $this->details['due_date']
        ];
    }
}