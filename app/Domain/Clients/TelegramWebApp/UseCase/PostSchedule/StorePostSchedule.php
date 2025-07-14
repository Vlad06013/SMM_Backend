<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\PostSchedule\PostScheduleService;
use App\Repository\PostStorage;

class StorePostSchedule
{
    public function __construct(protected PostScheduleService  $postScheduleService)
    {
    }

    public function __invoke(int $postId, array $dates): PostResource
    {
        $this->postScheduleService->create($postId, $dates);

        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
