<?php

use Illuminate\Support\Facades\Route;

Route::prefix('telegram-webapp/v1')->group(function () {
    require base_path('app/Domain/Clients/TelegramWebApp/routes/api.php');
});
