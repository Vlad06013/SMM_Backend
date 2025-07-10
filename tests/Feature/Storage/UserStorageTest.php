<?php

namespace Storage;

use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserStorageTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Создание пользователя с балансом
     *
     * @return void
     */
    public function test_create(): void
    {
        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();

        $this->assertDatabaseHas('users', (array)$userDto);
        $this->assertDatabaseHas('balance_accounts', ['id' => $createdUser->balance_id]);
    }

    /**
     * Обновление пользователя
     *
     * @return void
     */
    public function test_update(): void
    {
        $userService = app(UserService::class);

        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();

        $createdUser->name = 'updated_name';
        $createdUser->telegram_id = 'updated_telegram_id';
        $createdUser->login = 'updated_login';

        $updated = $userService->update($createdUser);
        $this->assertDatabaseHas('users', $updated->toArray());
    }

    /**
     * Обновление пользователя
     *
     * @return void
     */
    public function test_show(): void
    {
        $userService = app(UserService::class);
        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();

        $user = $userService->getById($createdUser->id);
        $this->assertEquals($createdUser->toArray(), $user->toArray());
    }

    /**
     * Удаление пользователя
     *
     * @return void
     */
    public function test_delete(): void
    {
        $userService = app(UserService::class);
        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();
        $user = $userService->delete($createdUser->id);

        $this->assertDatabaseMissing('users', $createdUser->toArray());
    }

    /**
     * Создание пользователя
     *
     * @return array
     */
    public function seedUser(): array
    {
        $userService = app(UserService::class);

        $userDto = new CreateUserDto(
            name: 'test',
            telegram_id: '111',
            login: '111',
        );
        $createdUser = $userService->create($userDto);

        return compact('userDto', 'createdUser');
    }
}
