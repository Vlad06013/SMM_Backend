<?php

namespace App\Domain\Services\ClientChannel;

use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Models\Channels\ClientChannel;
use App\Repository\ClientChannelStorage;
use Illuminate\Support\Collection;
use RuntimeException;

class ClientChannelService
{
    public function __construct(protected ClientChannelStorage $clientChannelStorage)
    {
    }

    /**
     * Создание канала
     *
     * @param CreateClientChannelDto $createClientChannelDto
     * @return ClientChannel
     * @throws RuntimeException
     */
    public function create(CreateClientChannelDto $createClientChannelDto): ClientChannel
    {
        $clientChannelModel = new ClientChannel();
        $clientChannelModel->user_id = $createClientChannelDto->user_id;
        $clientChannelModel->posting_resource_id = $createClientChannelDto->posting_resource_id;
        $clientChannelModel->name = $createClientChannelDto->name;
        $clientChannelModel->auto_signature = $createClientChannelDto->auto_signature;
        $clientChannelModel->auto_punctuation = $createClientChannelDto->auto_punctuation;
        $clientChannelModel->water_marks_id = $createClientChannelDto->water_marks_id;
        $clientChannelModel->reposter_id = $createClientChannelDto->reposter_id;

        return $this->clientChannelStorage->store($clientChannelModel);
    }

    /**
     * Получение каналов пользователя
     *
     * @param int $userId
     * @return Collection<ClientChannel>|null
     * @throws RuntimeException
     */
    public function getByUserId(int $userId): ?Collection
    {
        return $this->clientChannelStorage->getByUserId($userId);
    }

    /**
     * Получение канала по Ид
     *
     * @param int $channelId
     * @return ClientChannel|null
     * @throws RuntimeException
     */
    public function show(int $channelId): ?ClientChannel
    {
        return $this->clientChannelStorage->show($channelId);
    }

    /**
     * Удаление канала по Ид
     *
     * @param int $channelId
     * @return ClientChannel|null
     * @throws RuntimeException
     */
    public function delete(int $channelId): ?ClientChannel
    {
        return $this->clientChannelStorage->destroy($channelId);
    }
}
