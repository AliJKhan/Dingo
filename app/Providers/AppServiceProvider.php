<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if (env('APP_ENV') == 'local') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);

        }
        else{
            $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);
        }
    }
}
