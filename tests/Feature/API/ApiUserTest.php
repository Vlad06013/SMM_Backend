<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ApiUserTest extends TestCase
{
    use RefreshDatabase;


    public function test_index(): void
    {
        Seeder::seedUser();
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
        Seeder::seedUser();
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

    public function test_store(): void
    {
        $response = $this->postJson('/api/telegram-webapp/v1/user/',
            [
                "name" => "test",
                "telegram_id" => "111",
                "login" => "111",
            ]);
        $response->assertStatus(201)
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

    public function test_update(): void
    {
        Seeder::seedUser();

        $response = $this->putJson('/api/telegram-webapp/v1/user/1',
            [
                "name" => "test_update",
                "telegram_id" => "111_update",
                "login" => "111_update",
            ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "name" => "test_update",
                    "telegram_id" => "111_update",
                    "login" => "111_update",
                    "balance" => [
                        'id' => 1,
                        'value' => 0,
                    ],
                ]
            ]);
    }

    public function test_delete(): void
    {
        Seeder::seedUser();
        $response = $this->deleteJson('/api/telegram-webapp/v1/user/1');
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

}
