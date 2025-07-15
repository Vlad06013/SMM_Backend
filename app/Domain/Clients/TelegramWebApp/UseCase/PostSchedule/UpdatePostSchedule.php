<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\PostSchedule\PostScheduleService;
use App\Repository\PostStorage;
use Carbon\Carbon;

class UpdatePostSchedule
{
    public function __construct(protected PostScheduleService  $postScheduleService)
    {
    }

    public function __invoke(int $postId, int $schedule_id, string $date): PostResource
    {
        $this->postScheduleService->update($schedule_id, Carbon::parse($date));

        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
