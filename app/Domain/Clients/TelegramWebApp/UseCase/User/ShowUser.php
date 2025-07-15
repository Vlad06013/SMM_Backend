<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\UserService;
use App\Models\User;

class ShowUser
{
    public function __construct(protected UserService $userService)
    {
    }
    public function __invoke(User $user): UserResource
    {
        return new UserResource($user);
    }
}
