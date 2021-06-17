<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionRenewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;
    public $owner;
    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription, $owner, $subscriber)
    {
        $this->subscription = $subscription;
        $this->owner = $owner;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscription-renew-successful');
    }
}
