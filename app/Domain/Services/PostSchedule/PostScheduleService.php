<?php

namespace App\Domain\Services\PostSchedule;

use App\Models\Post\PostSchedule;
use App\Repository\PostScheduleStorage;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use RuntimeException;

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
     * @throws RuntimeException
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
     * Изменение даты расписания
     *
     * @param int $scheduleId
     * @param Carbon $date
     * @return PostSchedule
     * @throws RuntimeException
     */
    public function update(int $scheduleId, Carbon $date): PostSchedule
    {
        $postScheduleModel = $this->postScheduleStorage->show($scheduleId);
        $postScheduleModel->send_planed_date = $date;

        $this->postScheduleStorage->update($postScheduleModel);

        return $postScheduleModel->fresh();
    }

    /**
     * Удаление даты постинга
     *
     * @param int $scheduleId
     * @return PostSchedule
     * @throws RuntimeException
     */
    public function delete(int $scheduleId): PostSchedule
    {
        return $this->postScheduleStorage->destroy($scheduleId);
    }
}
