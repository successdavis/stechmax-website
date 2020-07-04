<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ThreadHasNewReply' => [
            'App\Listeners\NotifyThreadSubscribers',
        ],
        'App\Events\PaymentWasAdded' => [
            'App\Listeners\SendPaymentReceipt',
            'App\Listeners\CloseInvoiceIfNeccessary',
        ],
        'App\Events\SystemNoAssigned' => [
            'App\Listeners\EmailSystemNumber',
            'App\Listeners\MessageSystemNumber',
        ],
        'App\Events\UserSubscribedToCourse' => [
            'App\Listeners\OnUserSubscribedToCourse',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
