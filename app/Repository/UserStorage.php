<?php

namespace App\Repository;

use App\Models\User;

/**
 * @property string $model
 * @method store(User $model)
 * @method index()
 * @method show(int $id)
 * @method update(User $model)
 * @method destroy(int $id)
 */
final class UserStorage extends CrudStorage
{
    public static ?string $model =  User::class;
}
