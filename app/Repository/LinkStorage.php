<?php

namespace App\Repository;

use App\Models\Post\Link;

/**
 * @property string $model
 * @method store(Link $model)
 * @method index()
 * @method show(int $id)
 * @method update(Link $model)
 * @method destroy(int $id)
 */
final class LinkStorage extends CrudStorage
{
    public static ?string $model =  Link::class;
}
