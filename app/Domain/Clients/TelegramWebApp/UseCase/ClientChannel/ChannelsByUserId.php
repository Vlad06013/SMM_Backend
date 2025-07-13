<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel;

use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelsResource;
use App\Domain\Services\ClientChannel\ClientChannelService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChannelsByUserId
{
    public function __construct(protected ClientChannelService $clientChannelService)
    {
    }
    public function __invoke(int $userId): AnonymousResourceCollection
    {
        return ClientChannelsResource::collection($this->clientChannelService->getByUserId($userId));
    }
}
