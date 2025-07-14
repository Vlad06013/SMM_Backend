<?php

namespace App\Domain\Services\PostChannel;

use App\Models\Post\PostChannel;
use App\Repository\PostChannelStorage;

class PostChannelService
{
    public function __construct(protected PostChannelStorage $postChannelStorage)
    {
    }

    /**
     * Создание связки канала к посту
     *
     * @param int $postId
     * @param int $channelId
     * @return PostChannel
     */
    public function create(int $postId, int $channelId): PostChannel
    {
        if ($this->postChannelStorage->getByPostIdChannelID($postId, $channelId)) {
            throw new \RuntimeException('Канал публикации уже назначен посту');
        }
        $postChannel = new PostChannel();
        $postChannel->post_id = $postId;
        $postChannel->channel_id = $channelId;

        return $this->postChannelStorage->store($postChannel);
    }

    /**
     * Удаление связки канала к посту
     *
     * @param int $postId
     * @param int $channelId
     * @return PostChannel
     */
    public function delete(int $postId, int $channelId): PostChannel
    {
        $postChannel = $this->postChannelStorage->getByPostIdChannelID($postId, $channelId);

        return $this->postChannelStorage->destroy($postChannel->id);
    }
}
