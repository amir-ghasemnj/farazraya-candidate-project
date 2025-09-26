<?php

use App\Jobs\ReleaseExpiredReserves;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        // add release expired reserves to schedules
        $schedule->job(ReleaseExpiredReserves::class)->everyThirtySeconds();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // un-authenticated
        $exceptions->render(function (
            \Illuminate\Auth\AuthenticationException $exception,
            \Illuminate\Http\Request                 $request
        ) {
            return \App\Utils\ResponseUtil::factory(401, 401, __('errors.unauthenticated'));
        });

        // un-authorized
        $exceptions->render(function (\Illuminate\Auth\Access\AuthorizationException $exception,
                                      \Illuminate\Http\Request                       $request) {
            return \App\Utils\ResponseUtil::factory(401, 401, __('errors.unauthorized'));
        });

        // unexcepted errors
        $exceptions->render(function (\Throwable               $exception,
                                      \Illuminate\Http\Request $request) {
            if (!env('APP_DEBUG'))
                return \App\Utils\ResponseUtil::factory(500, 500, __('errors.unexpected'));
        });
    })->create();
