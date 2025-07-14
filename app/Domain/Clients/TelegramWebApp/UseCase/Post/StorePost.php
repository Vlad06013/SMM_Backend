<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\PostService;

class StorePost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(array $postData): PostResource
    {
        $createPostDto = new CreatePostDto(
            $postData['creator_id'],
            $postData['title'],
            $postData['text'],
        );
        return new PostResource($this->postService->create($createPostDto));
    }
}
