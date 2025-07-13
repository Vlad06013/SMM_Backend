<?php

namespace Service;

use App\Domain\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Создание пользователя с балансом
     *
     * @return void
     */
    public function test_create(): void
    {
        $createdUser = Seeder::seedUser();

        $this->assertDatabaseHas('users',
            [
                "name" => 'test',
                'telegram_id' => '111',
                'login' => '111',
            ]
        );
        $this->assertDatabaseHas('balance_accounts', ['id' => $createdUser->balance_id, 'value' => 0]);
    }

    /**
     * Обновление пользователя
     *
     * @return void
     */
    public function test_update(): void
    {
        $userService = app(UserService::class);

        $createdUser = Seeder::seedUser();

        $createdUser->name = 'updated_name';
        $createdUser->telegram_id = 'updated_telegram_id';
        $createdUser->login = 'updated_login';

        $updated = $userService->update($createdUser);
        $this->assertDatabaseHas('users',
            [
                "id" => $createdUser->id,
                "name" => 'updated_name',
                "telegram_id" => 'updated_telegram_id',
                "login" => 'updated_login',
            ]
        );
    }

    /**
     * Обновление пользователя
     *
     * @return void
     */
    public function test_show(): void
    {
        $userService = app(UserService::class);
        $createdUser = Seeder::seedUser();

        $user = $userService->getById($createdUser->id);
        $userArray = $user->toArray();
        unset($userArray['created_at'], $userArray['updated_at']);
        $this->assertEquals(
            [
                "id" => $createdUser->id,
                "name" => 'test',
                "telegram_id" => '111',
                "login" => '111',
                'balance_id' => $createdUser->balance_id,
            ],
            $userArray);
    }

    /**
     * Список пользователей пользователя
     *
     * @return void
     */
    public function test_index(): void
    {
        $userService = app(UserService::class);
        $createdUser = Seeder::seedUser();

        $users = $userService->index();
        foreach ($users as $user) {
            $userArray = $user->toArray();
            unset($userArray['created_at'], $userArray['updated_at']);
            $this->assertEquals([
                "id" => $createdUser->id,
                "name" => 'test',
                "telegram_id" => '111',
                "login" => '111',
                'balance_id' => $createdUser->balance_id,
            ],
                $userArray);
        }
    }

    /**
     * Удаление пользователя
     *
     * @return void
     */
    public function test_delete(): void
    {
        $userService = app(UserService::class);
        $createdUser = Seeder::seedUser();
       $userService->delete($createdUser->id);

        $this->assertDatabaseMissing('users', [
            "id" => $createdUser->id,
            "name" => 'test',
            "telegram_id" => '111',
            "login" => '111',
            'balance_id' => $createdUser->balance_id,
        ]);
    }
}
