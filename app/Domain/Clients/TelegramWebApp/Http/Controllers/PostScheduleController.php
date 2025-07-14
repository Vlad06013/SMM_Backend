<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\DeletePostSchedule;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\StorePostSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PostScheduleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }

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


    public function show(string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function update(Request $request, string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    /**
     * @throws ValidationException
     */
    public function destroy(string $post_id, string $id)
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
