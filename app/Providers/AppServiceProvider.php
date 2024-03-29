<?php

namespace App\Providers;

use App\Channel;
use App\Http\Resources\InvoicesResource;
use App\Http\Resources\subjectResource;
use App\Rules\SpamFree;
use App\Subject;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['forum.create', 'forum.index', 'forum.show'], function ($view) {
            $channels = \Cache::rememberForever('channels', function() {
                return Channel::all();
            });
            $view->with('channels', $channels);
        });

        // \View::composer('*', function ($view) {
        //     $subjects = \Cache::rememberForever('subjects', function() {
        //         return Subject::all();
        //     });
        //     $view->with('subjects', subjectResource::collection($subjects));
        // });

        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
        \Validator::extend('emailorphone', 'App\Rules\EmailOrPhone@passes');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
