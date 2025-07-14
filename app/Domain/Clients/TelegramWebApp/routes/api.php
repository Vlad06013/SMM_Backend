<?php


use App\Domain\Clients\TelegramWebApp\Http\Controllers\ClientChannelController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\PostChannelController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\PostController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\PostLinkController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\PostScheduleController;
use App\Domain\Clients\TelegramWebApp\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user', UserController::class);
Route::apiResource('user/{user_id}/channel', ClientChannelController::class);

Route::apiResource('post', PostController::class);
Route::apiResource('post/{id}/channels', PostChannelController::class)->only(['store', 'destroy']);
Route::apiResource('post/{id}/schedule', PostScheduleController::class)->only(['store', 'destroy']);
Route::apiResource('post/{id}/link', PostLinkController::class)->only(['store', 'destroy']);

