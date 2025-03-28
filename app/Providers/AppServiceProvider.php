<?php

namespace App\Providers;

use App\Services\GameService;
use App\Services\PlayerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('playerService', PlayerService::class);
        $this->app->singleton('gameService', GameService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
