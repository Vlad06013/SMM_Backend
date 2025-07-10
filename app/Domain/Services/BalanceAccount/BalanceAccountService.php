<?php

namespace App\Domain\Services\BalanceAccount;

use App\Models\BalanceAccount\BalanceAccount;
use App\Repository\BalanceAccountStorage;

class BalanceAccountService
{
    public function __construct(
        protected BalanceAccountStorage $balanceAccountStorage
    )
    {
    }

    public function create(): BalanceAccount
    {
        return $this->balanceAccountStorage->store(new BalanceAccount());
    }
}
