<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\UpdatePostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostChannel\DeletePostChannel;
use App\Domain\Clients\TelegramWebApp\UseCase\PostChannel\StorePostChannel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostChannelController extends Controller
{
    public function index(Request $request)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @param Request $request
     * @param string $post_id
     * @return PostResource
     */
    public function store(Request $request, string $post_id)
    {
        $data = $request->validate(['channel_id' => 'required|exists:client_channels,id']);
        return app(StorePostChannel::class)($post_id, $data['channel_id']);
    }


    public function show(string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function update(UpdatePostRequest $request, string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function destroy(string $post_id, string $id)
    {
        return app(DeletePostChannel::class)($post_id, $id);
    }
}
