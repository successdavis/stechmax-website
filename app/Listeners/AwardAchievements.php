<?php

namespace App\Listeners;

use App\Events\UserEarnedExperience;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardAchievements
{
    /**
     * Handle the event.
     *
     * @param  UserEarnedExperience  $event
     * @return void
     */
    public function handle(UserEarnedExperience $event)
    {
        $event->user->achievements()->sync(
            app('achievements')->filter->qualifier($event->user)->map->modelKey()
        );
        
    }
}
