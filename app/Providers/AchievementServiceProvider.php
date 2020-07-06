<?php

namespace App\Providers;

use App\Achievements\FirstThousandPoints;
use App\Achievements\StechmaxMasteryPoints;
use Illuminate\Support\ServiceProvider;

class AchievementServiceProvider extends ServiceProvider
{
    protected $achievements = [
        FirstThousandPoints::class,
        StechmaxMasteryPoints::class
    ];
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
