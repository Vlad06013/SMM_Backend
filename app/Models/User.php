<?php

namespace App\Models;

use App\Models\BalanceAccount\BalanceAccount;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $id Ид
 * @property string $name Имя в телеграм
 * @property string $telegram_id Ид в телеграм
 * @property string $login Логин в телеграм
 * @property string $balance_id Ид баланса
 * @property BalanceAccount $balance Баланс
 */
//#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'telegram_id',
        'login',
        'balance_id',
    ];

    /**
     * Баланс
     *
     * @return HasOne
     */
    public  function balance(): HasOne
    {
        return $this->hasOne(BalanceAccount::class, 'id', 'balance_id');
    }
}
