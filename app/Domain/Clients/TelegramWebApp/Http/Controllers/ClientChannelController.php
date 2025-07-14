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

class ClientChannelController extends Controller
{

    /**
     * @param Request $request
     * @param string $user_id
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, string $user_id): AnonymousResourceCollection
    {
        return app(ChannelsByUserId::class)($user_id);
    }

    /**
     * @param ClientChannelRequest $request
     * @param string $user_id
     * @return ClientChannelResource
     */
    public function store(ClientChannelRequest $request, string $user_id): ClientChannelResource
    {
        $data = $request->validated();
        $data['user_id'] = $user_id;

        $createChanelDto = new CreateClientChannelDto(...$data);
        return app(StoreClientChannel::class)($createChanelDto);
    }

    /**
     * @param string $user_id
     * @param string $id
     * @return ClientChannelResource
     */
    public function show(string $user_id, string $id): ClientChannelResource
    {
        return app(ShowClientChannel::class)($id);
    }

    /**
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * @param string $user_id
     * @param string $id
     * @return ClientChannelResource
     */
    public function destroy(string $user_id, string $id): ClientChannelResource
    {
        return app(DeleteClientChannel::class)($id);
    }
}
