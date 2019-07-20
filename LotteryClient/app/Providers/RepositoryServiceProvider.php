<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register UserRepository
        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository'
        );

        // Register EventRepository
        $this->app->bind(
            'App\Repositories\Event\EventRepositoryInterface',
            'App\Repositories\Event\EventRepository'
        );

        // Register CardRepository
        $this->app->bind(
            'App\Repositories\Card\CardRepositoryInterface',
            'App\Repositories\Card\CardRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
