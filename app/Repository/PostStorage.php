<?php

namespace App\Repository;

use App\Models\Post\Post;

/**
 * @property string $model
 * @method store(Post $model)
 * @method index()
 * @method show(int $id)
 * @method update(Post $model)
 * @method destroy(int $id)
 */
final class PostStorage extends CrudStorage
{
    public static ?string $model =  Post::class;
}
