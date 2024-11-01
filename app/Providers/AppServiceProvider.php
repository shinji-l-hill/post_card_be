<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $servicies = [
            'AdminAuthService'
        ];

        foreach($servicies as $service) {
            $this->app->bind(
                "App\\Contracts\\{$service}Interface",
                "App\\Services\\{$service}"
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
