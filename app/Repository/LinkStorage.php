<?php

namespace App\Repository;

use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Models\Post\Link;
use App\Models\Post\Post;

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

    /**
     * Синхронизация ссылок поста
     *
     * @param Post $post
     * @param PostLinkDto[] $postLinkDto
     * @return array
     */
    public function syncToPost(Post $post, array $postLinkDto): array
    {
        return $post->links()->sync(array_map(function ($linkDto){
            return (array)$linkDto;
        }, $postLinkDto));
    }
}
