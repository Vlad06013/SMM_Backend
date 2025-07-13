<?php

namespace App\Domain\Services\ClientChannel;

use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Models\Channels\ClientChannel;
use App\Models\Post\Post;
use App\Repository\ClientChannelStorage;

class ClientChannelService
{
    public function __construct( protected ClientChannelStorage $clientChannelStorage) {}

    /**
     * Создание канала
     *
     * @param CreateClientChannelDto $createClientChannelDto
     * @return ClientChannel
     */
    public function create(CreateClientChannelDto $createClientChannelDto): ClientChannel
    {
        $clientChannelModel = new ClientChannel();
        $clientChannelModel->user_id = $createClientChannelDto->user_id;
        $clientChannelModel->posting_resources_id = $createClientChannelDto->posting_resources_id;
        $clientChannelModel->name = $createClientChannelDto->name;
        $clientChannelModel->auto_signature = $createClientChannelDto->auto_signature;
        $clientChannelModel->auto_punctuation = $createClientChannelDto->auto_punctuation;
        $clientChannelModel->water_marks_id = $createClientChannelDto->water_marks_id;
        $clientChannelModel->reposter_id = $createClientChannelDto->reposter_id;

        return $this->clientChannelStorage->store($clientChannelModel);
    }

    /**
     * Синхронизация каналов поста
     *
     * @param Post $post
     * @param array $postChannelIds
     * @return array
     */
    public function syncToPost(Post $post, array $postChannelIds): array
    {
        return $this->clientChannelStorage->syncToPost($post, $postChannelIds);
    }
}
