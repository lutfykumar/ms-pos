<?php

namespace Modules\Superadmin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewSubscriptionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $subscription;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
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
        // $ownerName = $this->subscription->business->owner->surname . ' ' . $this->subscription->business->owner->first_name . ' ' . $this->subscription->business->owner->last_name;
        // $hello = 'Dear ' . $ownerName . ',';
        $paid_via = !empty($this->subscription->paid_via) ? $this->subscription->paid_via : 'Free';
        $details = 'Package: ' . $this->subscription->package->name . ' <br>Transaction ID: ' . $this->subscription->payment_transaction_id . ' <br>Paid Via: ' . $paid_via;

        return (new MailMessage)
            ->subject('New Subscription')
            ->greeting('Dear Admin,')
            ->line('New package has been subscribed by ' . $this->subscription->business->name)
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
