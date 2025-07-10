<?php

namespace Tests\Feature\API;

use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCrudUsers extends TestCase
{
    use RefreshDatabase;


    public function test_index(): void
    {
        $this->seedUser();
        $response = $this->getJson('/api/telegram-webapp/v1/user');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        "id" => 1,
                        "name" => "test",
                        "telegram_id" => "111",
                        "login" => "111",
                    ]
                ]
            ]);
    }

    public function test_show(): void
    {
        $this->seedUser();
        $response = $this->getJson('/api/telegram-webapp/v1/user/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "name" => "test",
                    "telegram_id" => "111",
                    "login" => "111",
                    "balance" => [
                        'id' => 1,
                        'value' => 0,
                    ],
                ]
            ]);
    }

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
