<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SimAlert extends Notification
{
    use Queueable;
    private $sim_id;
    private $user_create;

    /**
     * Create a new notification instance.
     */
    public function __construct ($sim_id, $user_create)
    {
        $this->sim_id = $sim_id;
        $this->user_create = $user_create;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
   

    /**
     * Get the mail representation of the notification.
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->sim_id,
            'title' => 'الاشتراك قارب علي الانتهاء',
            'user' => $this->user_create
        ];
    }   
}
