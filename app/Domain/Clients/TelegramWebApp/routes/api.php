<?php


use App\Domain\Clients\TelegramWebApp\Http\Controllers\ClientChannelController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\PostController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user',UserController::class);
Route::apiResource('client-channel', ClientChannelController::class);
Route::apiResource('post', PostController::class);
