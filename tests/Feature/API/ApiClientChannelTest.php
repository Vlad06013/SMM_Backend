<?php

namespace API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ApiClientChannelTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel($user->id);
        $response = $this->getJson('/api/telegram-webapp/v1/client-channel?userId=' . $user->id);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        "id" => $channel->id,
                        "name" => "channelName",
                        "resource" => [
                            "id" => $resource->id,
                            "name" => "telegram",
                        ],
                    ]
                ]
            ]);
    }

    public function test_show(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel($user->id);
        $response = $this->getJson('/api/telegram-webapp/v1/client-channel/' . $user->id);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => $channel->id,
                    "name" => "channelName",
                    "auto_signature" => false,
                    "auto_punctuation" => false,
                    "water_marks_id" => null,
                    "reposter_id" => null,
                    "resource" => [
                        'id' => $resource->id,
                        'name' => 'telegram',
                    ],
                ]
            ]);
    }
//
//    public function test_store(): void
//    {
//        $response = $this->postJson('/api/telegram-webapp/v1/user/',
//            [
//                "name" => "test",
//                "telegram_id" => "111",
//                "login" => "111",
//            ]);
//        $response->assertStatus(201)
//            ->assertJson([
//                'data' => [
//                    "id" => $response->json()['data']['id'],
//                    "name" => "test",
//                    "telegram_id" => "111",
//                    "login" => "111",
//                    "balance" => [
//                        'id' => $response->json()['data']['balance']['id'],
//                        'value' => 0,
//                    ],
//                ]
//            ]);
//    }
//
//    public function test_update(): void
//    {
//        $user = Seeder::seedUser();
//
//        $response = $this->putJson('/api/telegram-webapp/v1/user/' . $user->id,
//            [
//                "name" => "test_update",
//                "telegram_id" => "111_update",
//                "login" => "111_update",
//            ]);
//        $response->assertStatus(200)
//            ->assertJson([
//                'data' => [
//                    "id" => $response->json()['data']['id'],
//                    "name" => "test_update",
//                    "telegram_id" => "111_update",
//                    "login" => "111_update",
//                    "balance" => [
//                        'id' => $response->json()['data']['balance']['id'],
//                        'value' => 0,
//                    ],
//                ]
//            ]);
//    }
//
//    public function test_delete(): void
//    {
//        $user = Seeder::seedUser();
//        $response = $this->deleteJson('/api/telegram-webapp/v1/user/' . $user->id);
//        $response
//            ->assertStatus(200)
//            ->assertJson([
//                'data' => [
//                    "id" => $user->id,
//                    "name" => "test",
//                    "telegram_id" => "111",
//                    "login" => "111",
//                    "balance" => [
//                        'id' => $user->balance->id,
//                        'value' => 0,
//                    ],
//                ]
//            ]);
//    }

}
