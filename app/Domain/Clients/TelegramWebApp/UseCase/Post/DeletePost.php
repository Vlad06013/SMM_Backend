<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\Post\PostService;

class DeletePost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(int $postId): PostResource
    {
        return new PostResource($this->postService->delete($postId));
    }
}
