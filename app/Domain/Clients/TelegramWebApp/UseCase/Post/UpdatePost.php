<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Domain\Services\Post\DTO\UpdatePostDto;
use App\Domain\Services\Post\PostService;
use Carbon\Carbon;

class UpdatePost
{
    public function __construct(protected PostService $postService)
    {
    }

    public function __invoke(array $updatePostData): PostResource
    {
//        if (isset($updatePostData['links'])) {
//            $updatePostData['links'] = array_map(function ($link) {
//                return new PostLinkDto(...$link);
//            }, $updatePostData['links']);
//        }
//
//        if (isset($updatePostData['scheduleDates'])) {
//            $updatePostData['scheduleDates'] = array_map(function ($date) {
//                return Carbon::parse($date);
//            }, $updatePostData['scheduleDates']);
//        }
        $updatePostDto = new UpdatePostDto(...$updatePostData);

        return new PostResource($this->postService->update($updatePostDto));
    }
}
