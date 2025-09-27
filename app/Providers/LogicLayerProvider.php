<?php

namespace App\Providers;

use App\LogicLayer\RoomLogic;
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
        $this->app->bind(RoomLogic::class, RoomLogic::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
