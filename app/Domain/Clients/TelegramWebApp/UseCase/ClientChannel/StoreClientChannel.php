<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel;

use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;

class StoreClientChannel
{
    public function __construct(protected ClientChannelService $clientChannelService)
    {
    }

    public function __invoke(CreateClientChannelDto $clientChannelDto): ClientChannelResource
    {
        return new ClientChannelResource($this->clientChannelService->create($clientChannelDto));
    }
}
