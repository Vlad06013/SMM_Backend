<?php

namespace App\Domain\Services\PostSchedule;

use App\Models\Post\Post;
use App\Repository\PostScheduleStorage;
use Carbon\Carbon;

class PostScheduleService
{
    public function __construct(protected PostScheduleStorage $postScheduleStorage)
    {
    }

    /**
     * Синхронизация расписания поста
     *
     * @param Post $post
     * @param Carbon[] $dates
     * @return array
     */
    public function syncToPost(Post $post, array $dates): array
    {
        return $this->postScheduleStorage->syncToPost($post, $dates);
    }
}
