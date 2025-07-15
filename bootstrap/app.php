<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::
//            middleware('api/telegram-webapp/v1')
                prefix('api/telegram-webapp/v1')
                ->group(base_path('app/Domain/Clients/TelegramWebApp/routes/api.php'));
        },
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        });
    })->create();
