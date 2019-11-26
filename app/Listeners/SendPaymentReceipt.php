<?php

namespace App\Listeners;

use App\Events\PaymentWasAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentReceipt
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
     * @param  PaymentWasAdded  $event
     * @return void
     */
    public function handle(PaymentWasAdded $event)
    {
        //
    }
}
