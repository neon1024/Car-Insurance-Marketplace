<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        // share globally data from session
        Inertia::share([
            "session" => function() {
                return [
                    "token" => session("auth_token"),
                    "token_expires_at" => session("auth_token_expires_at"),
                    "refresh_token" => session("refresh_auth_token")
                ];
            }
        ]);
    }
}
