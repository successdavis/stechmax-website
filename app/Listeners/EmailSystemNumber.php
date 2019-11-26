<?php

namespace App\Listeners;

use App\Events\SystemNoAssigned;
use App\Mail\EmailSystenNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailSystemNumber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SystemNoAssigned  $event
     * @return void
     */
    public function handle(SystemNoAssigned $event)
    {
        $owner = $event->subscription->owner;
        $subscriber = $event->subscription->subscriber;
        $subscription = $event->subscription;
        Mail::to($owner)->send(new EmailSystenNumber($subscription, $owner, $subscriber));
    }
}
