<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\UserRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\ChannelsByUserId;
use App\Domain\Clients\TelegramWebApp\UseCase\ClientChannel\ShowClientChannel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientChannelController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = $request->validate([
            'userId' => 'required|integer|exists:users,id',
        ]);
        return app(ChannelsByUserId::class)($data['userId']);
    }

    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
//        $data = $request->validated();
//
//        $createUserDto = new CreateUserDto(...$data);
//        return app(StoreUser::class)($createUserDto);
    }

    /**
     * @param string $id
     * @return ClientChannelResource
     */
    public function show(string $id): ClientChannelResource
    {
        return app(ShowClientChannel::class)($id);
    }

    /**
     * @param UserRequest $request
     * @param string $id
     * @return UserResource
     */
    public function update(UserRequest $request, string $id): UserResource
    {
//        $data = $request->validated();
//        $data['id'] = $id;
//        $updateDto = new UpdateUserDto(...$data);
//
//        return app(UpdateUser::class)($updateDto);
    }

    /**
     * @param string $id
     * @return UserResource
     */
    public function destroy(string $id): UserResource
    {
//        return app(DeleteUser::class)($id);
    }
}
