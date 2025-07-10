<?php


use App\Domain\Clients\TelegramWebApp\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user',UserController::class);
