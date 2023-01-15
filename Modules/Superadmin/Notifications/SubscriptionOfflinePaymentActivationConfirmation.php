<?php

namespace Modules\Superadmin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionOfflinePaymentActivationConfirmation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($business, $package, $ownerName)
    {
        $this->business = $business;
        $this->package = $package;
        $this->ownerName = $ownerName;
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
        $hello = 'Dear ' . $this->ownerName . ',';
        $details = 'Bisnis : ' . $this->business->name . ', Paket : ' . $this->package->name . ', Harga : ' . $this->package->price;

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
