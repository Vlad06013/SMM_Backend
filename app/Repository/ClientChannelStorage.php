<?php

namespace App\Repository;

use App\Models\Channels\ClientChannel;
use Illuminate\Support\Collection;

/**
 * @property string $model
 * @method store(ClientChannel $model)
 * @method index()
 * @method show(int $id)
 * @method update(ClientChannel $model)
 * @method destroy(int $id)
 */
final class ClientChannelStorage extends CrudStorage
{
    public static ?string $model =  ClientChannel::class;

    /**
     * Список каналов пользователя
     *
     * @param int $userId
     * @return Collection<ClientChannel>|null
     */
    public function getByUserId(int $userId): ?Collection
    {
        return app(self::$model)->where('user_id', $userId)->get();

    }
}
