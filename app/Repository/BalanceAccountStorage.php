<?php

namespace App\Repository;

use App\Models\BalanceAccount\BalanceAccount;

/**
 * @property string $model
 * @method store(BalanceAccount $model)
 * @method index()
 * @method show(int $id)
 * @method update(BalanceAccount $model)
 * @method destroy(int $id)
 */
final class BalanceAccountStorage extends CrudStorage
{
    public static ?string $model =  BalanceAccount::class;
}
