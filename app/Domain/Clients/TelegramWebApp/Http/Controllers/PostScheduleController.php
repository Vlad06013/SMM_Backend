<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\DeletePostSchedule;
use App\Domain\Clients\TelegramWebApp\UseCase\PostSchedule\StorePostSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     */
    public function store(Request $request, string $post_id): PostResource
    {
        $data = $request->validate([
            'scheduleDates' => 'required|array',
            'scheduleDates.*' => 'required|date',
        ]);

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


    public function destroy(string $post_id, string $id)
    {
        return app(DeletePostSchedule::class)($post_id, $id);
    }
}
