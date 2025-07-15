<?php

namespace API;

use Database\Seeders\Utils\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostChannelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_store(): void
    {
        Seeder::seedUser();
        Seeder::seedClientChannel();
        Seeder::seedPost();
        $response = $this->postJson('/api/telegram-webapp/v1/post/1/channels',
            [
                "channel_id" => 1,
            ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "creator" => [
                        'id' => 1,
                        'name' => 'test',
                        'telegram_id' => '111',
                        'login' => '111',
                        'balance' => [
                            'id' => 1,
                            'value' => 0,
                        ],
                    ],
                    "title" => "title",
                    "text" => "text",
                    "status" => "created",
                    "schedule" => [],
                    'links' => [],
                    'channels' => [
                        [
                            'id' => 1,
                            'name' => 'channelName',
                            'resource' => [
                                "id" => 1,
                                'name' => 'telegram'
                            ],
                        ]
                    ]
                ]
            ]);
    }

    public function test_delete(): void
    {
        Seeder::seedUser();
        Seeder::seedClientChannel();
        Seeder::seedPost();
        Seeder::seedPostChannel();
        $response = $this->deleteJson('/api/telegram-webapp/v1/post/1/channels/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "creator" => [
                        'id' => 1,
                        'name' => 'test',
                        'telegram_id' => '111',
                        'login' => '111',
                        'balance' => [
                            'id' => 1,
                            'value' => 0,
                        ],
                    ],
                    "title" => "title",
                    "text" => "text",
                    "status" => "created",
                    "schedule" => [],
                    'links' => [],
                    'channels' => []
                ]
            ]);
    }
}
