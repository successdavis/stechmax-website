<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnableToSetSystemNumber extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $user;
    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        return $this->user = $user;
        return $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.unable-to-set-system-no');
    }
}
