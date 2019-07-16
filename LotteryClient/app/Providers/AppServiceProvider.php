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
        $baseUrl = env('API_BASE_URL');

        $this->app->singleton('GuzzleHttp\Client', function($api) use ($baseUrl) {
            return new Client([
                'base_uri' => $baseUrl
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
