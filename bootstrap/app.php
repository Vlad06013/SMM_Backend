<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(

        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json(['error' => "Не найдено."], Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (AccessDeniedHttpException $e) {
            return response()->json(['error' => "Недостаточно прав."], Response::HTTP_UNAUTHORIZED);
        });
        $exceptions->render(function (RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() === 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $e->getCode());
        });
    })->create();
