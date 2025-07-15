<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\ClientChannelRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\ChannelsByUserId;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\DeleteClientChannel;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\ShowClientChannel;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\StoreClientChannel;
use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ClientChannelController extends Controller
{

    /**
     * @param Request $request
     * @param string $user_id
     * @return AnonymousResourceCollection
     * @throws ValidationException
     */
    public function index(Request $request, string $user_id): AnonymousResourceCollection
    {
        $validator = Validator::make(
            ['user_id' => $user_id],
            ['user_id' => 'required|integer|exists:users,id']
        );
        $data = $validator->validate();

        return app(ChannelsByUserId::class)($data['user_id']);
    }

    /**
     * @param ClientChannelRequest $request
     * @param string $user_id
     * @return ClientChannelResource
     * @throws ValidationException
     */
    public function store(ClientChannelRequest $request, string $user_id): ClientChannelResource
    {
        $data = $request->validated();

        $validator = Validator::make(
            ['user_id' => $user_id],
            ['user_id' => 'required|integer|exists:users,id']
        );

        $validatedUser = $validator->validate();
        $data['user_id'] = $validatedUser['user_id'];

        $createChanelDto = new CreateClientChannelDto(...$data);

        return app(StoreClientChannel::class)($createChanelDto);
    }

    /**
     * @param string $user_id
     * @param string $id
     * @return ClientChannelResource
     * @throws ValidationException
     */
    public function show(string $user_id, string $id): ClientChannelResource
    {
        $validator = Validator::make(
            ['user_id' => $user_id, 'channel_id' => $id],
            [
                'user_id' => 'required|integer|exists:users,id',
                'channel_id' => 'required|integer|exists:client_channels,id'
            ]
        );

        $data = $validator->validate();
        return app(ShowClientChannel::class)($data['channel_id']);
    }

    /**
     * @param string $user_id
     * @param string $id
     * @return ClientChannelResource
     * @throws ValidationException
     */
    public function destroy(string $user_id, string $id): ClientChannelResource
    {
        $validator = Validator::make(
            ['user_id' => $user_id, 'channel_id' => $id],
            [
                'user_id' => 'required|integer|exists:users,id',
                'channel_id' => 'required|exists:client_channels,id'
            ]
        );
        $data = $validator->validate();

        return app(DeleteClientChannel::class)($data['channel_id']);
    }
}
