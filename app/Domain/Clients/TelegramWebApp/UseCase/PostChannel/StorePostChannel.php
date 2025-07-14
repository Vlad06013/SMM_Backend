<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostChannel;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\PostChannel\PostChannelService;
use App\Models\Post\Post;

class StorePostChannel
{
    public function __construct(protected PostChannelService $postChannelService)
    {
    }

    public function __invoke(int $postId, int $channelId)
    {
        $this->postChannelService->create($postId, $channelId);
        return new PostResource(Post::find($postId));
    }
}
