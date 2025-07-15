<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostChannel\DeletePostChannel;
use App\Domain\Clients\TelegramWebApp\UseCase\PostChannel\StorePostChannel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostChannelController extends Controller
{

    /**
     * Привязка канала к посту
     *
     * @param Request $request
     * @param string $post_id
     * @return PostResource
     * @throws ValidationException
     */
    public function store(Request $request, string $post_id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'channel_id' => $request->get('channel_id')],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'channel_id' => 'required|exists:client_channels,id'
            ]
        );
        $data = $validator->validate();

        return app(StorePostChannel::class)($post_id, $data['channel_id']);
    }


    /**
     * Удаление канала поста
     *
     * @param string $post_id
     * @param string $id
     * @return PostResource
     * @throws ValidationException
     */
    public function destroy(string $post_id, string $id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'channel_id' => $id],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'channel_id' => 'required|exists:client_channels,id'
            ]
        );
        $data = $validator->validate();
        return app(DeletePostChannel::class)($data['post_id'], $data['channel_id']);
    }
}
