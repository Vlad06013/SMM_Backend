<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UsersResource;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;

class StoreUser
{
    public function __construct(protected UserService $userService)
    {
    }
    public function __invoke(CreateUserDto $createUserDto): UsersResource
    {
        return new UsersResource($this->userService->create($createUserDto));
    }
}
