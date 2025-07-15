<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\DTO\UserDto;
use App\Domain\Services\User\UserService;

class StoreUser
{
    public function __construct(protected UserService $userService)
    {
    }
    public function __invoke(UserDto $createUserDto): UserResource
    {
        return new UserResource($this->userService->create($createUserDto));
    }
}
