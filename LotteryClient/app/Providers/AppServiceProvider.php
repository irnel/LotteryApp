<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register client
        $this->app->singleton('GuzzleHttp\Client', function() {
            return new Client([
                'base_uri' => env('API_BASE_URL'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ] 
            ]);
        });

        // Register Service Adapter
        $this->app->bind(
            'App\Services\ApiInterface',
            'App\Services\ApiService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
