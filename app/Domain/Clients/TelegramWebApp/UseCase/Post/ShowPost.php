<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Post\PostService;

class ShowPost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(int $postId): PostResource
    {
        return new PostResource($this->postService->show($postId));
    }
}
