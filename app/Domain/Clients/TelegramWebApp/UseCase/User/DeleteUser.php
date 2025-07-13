<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\UserService;

class DeleteUser
{
    public function __construct(protected UserService $userService)
    {
    }
    public function __invoke(int $id): UserResource
    {
        return new UserResource($this->userService->delete($id));
    }
}
