<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ApiCrudUsers extends TestCase
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

}
