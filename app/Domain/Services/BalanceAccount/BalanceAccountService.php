<?php

namespace App\Domain\Services\BalanceAccount;

use App\Models\BalanceAccount\BalanceAccount;
use App\Repository\BalanceAccountStorage;

class BalanceAccountService
{
    public function __construct(protected BalanceAccountStorage $balanceAccountStorage)
    {
    }

    /**
     * Создание баланса пользователя
     *
     * @return BalanceAccount
     */
    public function create(): BalanceAccount
    {
        return $this->balanceAccountStorage->store(new BalanceAccount());
    }
}
