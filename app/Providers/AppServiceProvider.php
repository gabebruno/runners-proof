<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Contracts\RaceRepositoryInterface',
            'App\Repositories\Eloquent\RaceRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\RunnerRepositoryInterface',
            'App\Repositories\Eloquent\RunnerRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
