<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use URL;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Gate::define('modify', function ($user) {
            if ($user->id) {
                return true;
            }
            return false;
        });
    }
}
