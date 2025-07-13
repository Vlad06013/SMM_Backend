<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\DTO\UpdateUserDto;
use App\Domain\Services\User\UserService;

class UpdateUser
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(UpdateUserDto $updateUserDto): UserResource
    {
        return new UserResource($this->userService->update($updateUserDto));
    }
}
