<?php

namespace App\Providers;

use App\Achievements\FirstThousandPoints;
use App\Achievements\StartUp;
use App\Achievements\Bingo;
use App\Achievements\SchoolInSession;
use App\Achievements\FullTimeLearner;
use App\Achievements\WelcomeToTheCommunity;
use App\Achievements\StechmaxEvangelist;
use App\Achievements\StechmaxVeteran;
use App\Achievements\StechmaxMaster;
use App\Achievements\StechmaxTutor;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AchievementServiceProvider extends ServiceProvider
{
    protected $achievements = [
        StartUp::class,
        Bingo::class,
        SchoolInSession::class,
        FullTimeLearner::class,
        WelcomeToTheCommunity::class,
        StechmaxEvangelist::class,
        StechmaxVeteran::class,
        StechmaxMaster::class,
        StechmaxTutor::class,
    ];


    public function boot()
    {
        Event::listen(\App\Events\UserEarnedExperience::class, \App\Listeners\AwardAchievements::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('achievements', function () {
            return collect($this->achievements)->map(function ($achievement) {
                return new $achievement;
            });
        });
    }
}
