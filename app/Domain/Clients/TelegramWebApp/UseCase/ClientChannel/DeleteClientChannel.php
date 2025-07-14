<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel;

use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Services\ClientChannel\ClientChannelService;

class DeleteClientChannel
{
    public function __construct(protected ClientChannelService $clientChannelService)
    {
    }

    public function __invoke(int $channelId): ClientChannelResource
    {
        return new ClientChannelResource($this->clientChannelService->delete($channelId));
    }
}
