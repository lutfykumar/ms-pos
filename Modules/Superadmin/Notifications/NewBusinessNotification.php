<?php

namespace Modules\Superadmin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBusinessNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $business;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($business)
    {
        $this->business = $business;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $details = 'Business: ' . $this->business->name . ' <br>Business Owner: ' . $this->business->owner->user_full_name . ' <br>Email: ' . $this->business->owner->email .
            ', <br>Business contact number: ' . $this->business->locations->first()->mobile;

        return (new MailMessage)
            ->subject('New Business Registration')
            ->greeting('Hello!')
            ->line('New business registered successfully')
            ->line($details);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
