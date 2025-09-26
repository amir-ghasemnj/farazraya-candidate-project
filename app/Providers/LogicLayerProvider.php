<?php

namespace App\Providers;

use App\LogicLayer\UserLogic;
use Illuminate\Support\ServiceProvider;

class LogicLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserLogic::class, UserLogic::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
