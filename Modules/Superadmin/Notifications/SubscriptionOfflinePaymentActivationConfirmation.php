<?php

namespace Modules\Superadmin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionOfflinePaymentActivationConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    public $business;
    public $package;
    public $price;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($business, $package, $price)
    {
        $this->business = $business;
        $this->package = $package;
        $this->price = $price;
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
        // $ownerName = $this->business->owner->surname . ' ' . $this->business->owner->first_name . ' ' . $this->business->owner->last_name;
        $hello = 'Dear Admin,';
        $details = 'Bisnis : ' . $this->business->name . '<br> Paket : ' . $this->package->name . ' <br>Harga : ' . $this->price;

        return (new MailMessage)
            ->greeting($hello)
            ->line('Harap konfirmasi Pembayaran Offline untuk berlangganan')
            ->line($details)
            ->line('Untuk mengonfirmasi, buka tab langganan superadmin dan konfirmasikan.');
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
