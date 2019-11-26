<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSystenNumber extends Mailable implements ShouldQueue
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
        return $this->markdown('emails.email-system-no');
    }
}
