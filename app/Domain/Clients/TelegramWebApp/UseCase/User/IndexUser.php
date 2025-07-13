<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UsersResource;
use App\Domain\Services\User\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class IndexUser
{
    public function __construct(protected UserService $userService)
    {
    }
    public function __invoke(): AnonymousResourceCollection
    {
        return UsersResource::collection($this->userService->index());

    }
}
