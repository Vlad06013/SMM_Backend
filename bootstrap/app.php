<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::
            middleware('api')->
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
        $exceptions->render(function (AccessDeniedHttpException $e) {
            return response()->json(['error' => "Недостаточно прав."], Response::HTTP_UNAUTHORIZED);
        });
        $exceptions->render(function (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        });
    })->create();
