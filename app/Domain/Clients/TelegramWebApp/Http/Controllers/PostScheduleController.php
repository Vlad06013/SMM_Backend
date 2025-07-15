<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\DeletePostSchedule;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\StorePostSchedule;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\UpdatePostSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostScheduleController extends Controller
{

    /**
     * @param Request $request
     * @param string $post_id
     * @return PostResource
     * @throws ValidationException
     */
    public function store(Request $request, string $post_id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'scheduleDates' => $request->get('scheduleDates')],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'scheduleDates' => 'required|array',
                'scheduleDates.*' => 'required|date',
            ]
        );
        $data = $validator->validate();

        return app(StorePostSchedule::class)($post_id, $data['scheduleDates']);
    }


    /**
     * Изменение даты расписания
     *
     * @param Request $request
     * @param string $post_id
     * @param string $id
     * @return PostResource
     * @throws ValidationException
     */
    public function update(Request $request, string $post_id, string $id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'scheduleDate' => $request->get('scheduleDate'), 'schedule_id' => $id],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'schedule_id' => 'required|integer|exists:post_schedules,id',
                'scheduleDate' => 'required|date',
            ]
        );
        $data = $validator->validate();

        return app(UpdatePostSchedule::class)($data['post_id'], $data['schedule_id'], $data['scheduleDate']);
    }


    /**
     * Удаление даты расписания
     *
     * @param string $post_id
     * @param string $id
     * @return PostResource
     * @throws ValidationException
     */
    public function destroy(string $post_id, string $id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'schedule_id' => $id],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'schedule_id' => 'required|integer|exists:post_schedules,id',
            ]
        );
        $data = $validator->validate();

        return app(DeletePostSchedule::class)($data['post_id'], $data['schedule_id']);
    }
}
