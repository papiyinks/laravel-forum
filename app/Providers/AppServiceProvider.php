<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \view()->composer('*', function ($view) {
            $view->with('channels', \App\Channel::all());
        });

        // OR \view()->share('channels', Channel::all()); but the table migrates before this makeing the first one better
    }
}
