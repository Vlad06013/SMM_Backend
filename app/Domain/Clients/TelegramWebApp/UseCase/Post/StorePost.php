<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Domain\Services\Post\PostService;
use Carbon\Carbon;

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
//            $postData['links'] ? array_map(function ($link) {
//                return new PostLinkDto(...$link);
//            }, $postData['links']) : [],
//            $postData['scheduleDates'] ? array_map(function ($date) {
//                return Carbon::parse($date);
//            }, $postData['scheduleDates']) : [],
//            $postData['attachmentIds'] ?? [],
//            $postData['channelIds'] ?? [],
        );
        return new PostResource($this->postService->create($createPostDto));
    }
}
