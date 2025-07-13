<?php

namespace App\Domain\Services\User;

use App\Domain\Services\BalanceAccount\BalanceAccountService;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Models\User;
use App\Repository\UserStorage;
use Illuminate\Support\Collection;

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
     * @param CreateUserDto $dto
     * @return User
     */
    public function create(CreateUserDto $dto): User
    {
        $balanceAccount = $this->balanceAccountService->create();
        $user = new User((array)$dto);

        $user->balance_id = $balanceAccount->id;

        return $this->userStorage->store($user);
    }

    /**
     * Обновление пользователя
     *
     * @param User $user
     * @return User|null
     */
    public function update(User $user): ?User
    {
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
        return  $this->userStorage->show($id);
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

    /**
     * @return Collection<User>|null
     */
    public function index(): ?Collection
    {
        return $this->userStorage->index();
    }
}
