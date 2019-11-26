<?php

namespace App\Listeners;

use App\Events\SystemNoAssigned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSystemNumber
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
        // $subscriber = $event->subscriber;
        $owner = $event->subscription->owner;
        $subscriber = $event->subscription->subscriber;

        $owner->MessageSystemNumber($event->subscription);
    }
}
