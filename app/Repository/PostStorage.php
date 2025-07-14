<?php

namespace App\Repository;

use App\Models\Post\Post;
use Illuminate\Support\Collection;

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

    /**
     * Список постов пользователя
     *
     * @param int $userId
     * @return Collection<Post>|null
     */
    public function getByUserId(int $userId): ?Collection
    {
        return app(self::$model)->where('creator_id', $userId)->get();
    }
}

