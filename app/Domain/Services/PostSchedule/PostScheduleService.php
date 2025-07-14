<?php

namespace App\Domain\Services\PostSchedule;

use App\Models\Post\PostSchedule;
use App\Repository\PostScheduleStorage;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PostScheduleService
{
    public function __construct(protected PostScheduleStorage $postScheduleStorage)
    {
    }

    /**
     * Создание дат постинга
     *
     * @param int $postId
     * @param array $dates
     * @return Collection<PostSchedule>
     */
    public function create(int $postId, array $dates): Collection
    {
        $postSchedules = collect();

        foreach ($dates as $date) {

            $postScheduleModel = new PostSchedule();
            $postScheduleModel->post_id = $postId;
            $postScheduleModel->send_planed_date = Carbon::parse($date);

            $created = $this->postScheduleStorage->store($postScheduleModel);
            $postSchedules->push($created);
        }

        return $postSchedules;
    }

    /**
     * @param int $scheduleId
     * @return PostSchedule
     */
    public function delete(int $scheduleId): PostSchedule
    {
        return $this->postScheduleStorage->destroy($scheduleId);
    }
}
