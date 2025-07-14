<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostsResource;
use App\Domain\Services\Post\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostsByUserId
{
    public function __construct(protected PostService $postService)
    {
    }
    public function __invoke(int $userId): AnonymousResourceCollection
    {
        return PostsResource::collection($this->postService->getByUserId($userId));
    }
}
