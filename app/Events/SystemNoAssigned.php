<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SystemNoAssigned
{
    use SerializesModels;

    public $subscription;
    public $owner;
    public $subscriber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($subscription, $owner, $subscriber)
    {
        $this->subscription = $subscription;
        $this->owner = $owner;
        $this->subscriber = $subscriber;
    }
}
