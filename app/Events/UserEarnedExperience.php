<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserEarnedExperience
{

    use Dispatchable, SerializesModels;

    public $user;
    public $experience;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $experience)
    {
        $this->user         = $user;
        $this->experience   = $experience;
    }
}
