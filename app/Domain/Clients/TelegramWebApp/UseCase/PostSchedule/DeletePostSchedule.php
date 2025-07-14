<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\PostSchedule\PostScheduleService;
use App\Repository\PostStorage;

class DeletePostSchedule
{
    public function __construct(protected PostScheduleService $postScheduleService)
    {
    }

    public function __invoke(int $postId, int $scheduleId): PostResource
    {
        $this->postScheduleService->delete($scheduleId);
        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
