<?php

namespace App\Listeners;

use App\Events\PaymentWasAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CloseInvoiceIfNeccessary
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
        $invoice = $event->payment->invoice;
        if ($invoice->amountOwed() <= 0) {
            $invoice->closeInvoice();
            return true;
        }
    }
}
