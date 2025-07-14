<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Post\DTO\UpdatePostDto;
use App\Domain\Services\Post\PostService;

class UpdatePost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(array $updatePostData): PostResource
    {
        $updatePostDto = new UpdatePostDto(...$updatePostData);

        return new PostResource($this->postService->update($updatePostDto));
    }
}
