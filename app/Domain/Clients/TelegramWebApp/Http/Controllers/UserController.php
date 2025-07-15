<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Domain\Clients\TelegramWebApp\UseCase\User\DeleteUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\ShowUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\StoreUser;
use App\Domain\Clients\TelegramWebApp\UseCase\User\UpdateUser;
use App\Domain\Services\User\DTO\UserDto;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Создание пользователя
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request): UserResource
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string',  'max:255'],
            'telegram_id' => ['nullable', 'string'],
            'login' => ['nullable', 'string'],
        ]);

        $createUserDto = new UserDto(...$validated);
        return app(StoreUser::class)($createUserDto);
    }

    /**
     * Получение пользователя по Ид
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
       Gate::authorize('view', $user);

        return app(ShowUser::class)($user);
    }

    /**
     * Обновление пользователя
     *
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function update(Request $request, User $user): UserResource
    {
        Gate::authorize('update', $user);

        $validated = $request->validate([
            'name' => ['nullable', 'string',  'max:255'],
        ]);

        return app(UpdateUser::class)($user, $validated);
    }

    /**
     * Удаление пользователя
     *
     * @param string $id
     * @return UserResource
     */
    public function destroy(string $id): UserResource
    {
        return app(DeleteUser::class)($id);
    }
}
