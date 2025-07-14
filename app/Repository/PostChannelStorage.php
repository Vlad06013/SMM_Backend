<?php

namespace App\Repository;

use App\Models\Post\PostChannel;

/**
 * @property string $model
 * @method store(PostChannel $model)
 * @method index()
 * @method show(int $id)
 * @method update(PostChannel $model)
 * @method destroy(int $id)
 */
final class PostChannelStorage extends CrudStorage
{
    public static ?string $model =  PostChannel::class;

    public function getByPostIdChannelID(int $postId, int $channelId): ?PostChannel
    {
        return app(self::$model)->where(['post_id' => $postId, 'channel_id' => $channelId])->first();
    }
}
