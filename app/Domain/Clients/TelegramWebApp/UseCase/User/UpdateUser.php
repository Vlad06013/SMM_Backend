<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\DTO\UserDto;
use App\Domain\Services\User\UserService;
use App\Models\User;

class UpdateUser
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(User $user, array $data): UserResource
    {
        $updateDto = new UserDto(...$data);
        $this->userService->update($user->id, $updateDto);

        return new UserResource($user->fresh());
    }
}
