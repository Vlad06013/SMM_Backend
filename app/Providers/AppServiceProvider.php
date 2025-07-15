<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        self::tgUserAuth();
    }

    /**
     * Кастомная авторизация по ид телеграм
     *
     * @return void
     */
    private static function tgUserAuth(): void
    {
        Auth::viaRequest('web-app', function (Request $request) {

            $tgUserID = $request->header('auth-telegram-id');
            if (is_int($tgUserID) || mb_strlen((int)$tgUserID) === mb_strlen($tgUserID)) {
                return User::where('telegram_id', $tgUserID)->first();
            }
            return null;
        });
    }
}
