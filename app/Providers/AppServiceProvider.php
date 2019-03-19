<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BshCase;
use App\Observers\BshCaseObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BshCase::observe(BshCaseObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
