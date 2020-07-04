<?php

namespace App\Listeners;

use App\Events\UserSubscribedToCourse;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnUserSubscribedToCourse
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserSubscribedToCourse $event)
    {
        $user = User::find($event->user);
        $user->awardExperience(100, 'New Subscriber Points');
    }
}
