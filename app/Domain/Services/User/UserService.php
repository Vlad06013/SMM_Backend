<?php

namespace App\Domain\Services\User;

use App\Domain\Services\BalanceAccount\BalanceAccountService;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\DTO\UpdateUserDto;
use App\Models\User;
use App\Repository\UserStorage;
use Illuminate\Support\Facades\DB;

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
     * @param CreateUserDto $dto
     * @return User|null
     */
    public function create(CreateUserDto $dto): ?User
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
     * @param UpdateUserDto $userDto
     * @return User|null
     */
    public function update(UpdateUserDto $userDto): ?User
    {
        $user = $this->userStorage->show($userDto->id);
        $userDto = collect($userDto)->filter(function ($value) {
            return !is_null($value);
        })->all();
        $user->fill($userDto);

        $this->userStorage->update($user);

        return $user->fresh();
    }

    /**
     * Получение пользователя по ид
     *
     * @param int $id
     * @return User|null
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
     */
    public function delete(int $id): ?User
    {
        return $this->userStorage->destroy($id);
    }

}
