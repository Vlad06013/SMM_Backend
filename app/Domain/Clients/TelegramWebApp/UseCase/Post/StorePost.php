<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\PostService;

class StorePost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(CreatePostDto $postDto): PostResource
    {
        return new PostResource($this->postService->create($postDto));
    }
}
