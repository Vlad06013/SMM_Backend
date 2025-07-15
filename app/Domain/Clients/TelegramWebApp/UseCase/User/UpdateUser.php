<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Services\User\DTO\UserDto;
use App\Domain\Services\User\UserService;

class UpdateUser
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(int $user_id, array $data): UserResource
    {
        $updateDto = new UserDto(...$data);
        $this->userService->update($user_id, $updateDto);

        return new UserResource($this->userService->getById($user_id));
    }
}
