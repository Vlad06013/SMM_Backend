<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\UserRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Clients\TelegramWebApp\UseCase\User\DeleteUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\ShowUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\StoreUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\UpdateUser;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\DTO\UpdateUserDto;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function store(UserRequest $request): UserResource
    {
        $data = $request->validated();

        $createUserDto = new CreateUserDto(...$data);
        return app(StoreUser::class)($createUserDto);
    }

    /**
     * @param string $id
     * @return UserResource
     */
    public function show(string $id): UserResource
    {
        return app(ShowUser::class)($id);
    }

    /**
     * @param UserRequest $request
     * @param string $id
     * @return UserResource
     */
    public function update(UserRequest $request, string $id): UserResource
    {
        $data = $request->validated();
        $data['id'] = $id;
        $updateDto = new UpdateUserDto(...$data);

        return app(UpdateUser::class)($updateDto);
    }

    /**
     * @param string $id
     * @return UserResource
     */
    public function destroy(string $id): UserResource
    {
        return app(DeleteUser::class)($id);
    }
}
