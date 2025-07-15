<?php

namespace App\Domain\Services\User;

use App\Domain\Services\BalanceAccount\BalanceAccountService;
use App\Domain\Services\User\DTO\UserDto;
use App\Models\User;
use App\Repository\UserStorage;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class UserService
{
    public function __construct(
        protected UserStorage           $userStorage,
        protected BalanceAccountService $balanceAccountService,
    )
    {
    }

    /**
     * Создание пользователя с нулевым балансом
     *
     * @param UserDto $dto
     * @return User|null
     * @throws RuntimeException
     */
    public function create(UserDto $dto): ?User
    {
        $userCreated = null;

        DB::transaction(function () use ($dto, &$userCreated) {

            $balanceAccount = $this->balanceAccountService->create();

            $user = new User((array)$dto);
            $user->balance_id = $balanceAccount->id;
            $userCreated = $this->userStorage->store($user);
        });

        return $userCreated;
    }

    /**
     * Обновление пользователя
     *
     * @param int $userId
     * @param UserDto $userDto
     * @return bool
     * @throws RuntimeException
     */
    public function update(int $userId, UserDto $userDto): bool
    {
        $user = $this->userStorage->show($userId);
        $userDto = collect($userDto)->filter(function ($value) {
            return !is_null($value);
        })->all();
        $user->fill($userDto);

        return $this->userStorage->update($user);
    }

    /**
     * Получение пользователя по ид
     *
     * @param int $id
     * @return User|null
     * @throws RuntimeException
     */
    public function getById(int $id): ?User
    {
        return $this->userStorage->show($id);
    }

    /**
     * Получение пользователя по ид
     *
     * @param int $id
     * @return User|null
     * @throws RuntimeException
     */
    public function delete(int $id): ?User
    {
        return $this->userStorage->destroy($id);
    }

}
