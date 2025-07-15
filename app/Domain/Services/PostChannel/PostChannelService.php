<?php

namespace App\Domain\Services\PostChannel;

use App\Models\Post\PostChannel;
use App\Repository\PostChannelStorage;
use RuntimeException;

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
     * @throws RuntimeException
     */
    public function create(int $postId, int $channelId): PostChannel
    {
        if ($this->postChannelStorage->getByPostIdChannelID($postId, $channelId)) {
            throw new \RuntimeException('Канал публикации уже назначен посту.');
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
     * @throws RuntimeException
     */
    public function delete(int $postId, int $channelId): PostChannel
    {
        if ($postChannel = $this->postChannelStorage->getByPostIdChannelID($postId, $channelId)) {
            return $this->postChannelStorage->destroy($postChannel->id);
        }
        throw new \RuntimeException('Канал публикации не назначен посту.');
    }
}
