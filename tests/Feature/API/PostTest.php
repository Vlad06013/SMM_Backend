<?php

namespace API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        Seeder::seedUser();
        Seeder::seedClientChannel();
        Seeder::seedPost();
        Seeder::seedScheduleDates();
        $response = $this->getJson('/api/telegram-webapp/v1/post?userId=1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        "id" => 1,
                        "creator_id" => 1,
                        "title" => "title",
                        "text" => "text",
                        "status" => "created",
                        "schedule" => [
                            [
                                "id" => 1,
                                "send_planed_date" => "2027-01-01 00:00:00",
                            ]
                        ],
                    ]
                ]
            ]);
    }

    public function test_show(): void
    {
        Seeder::seedUser();
        Seeder::seedPost();
        Seeder::seedClientChannel();
        Seeder::seedPostChannels();
        Seeder::seedAttachment();
        Seeder::seedPostAttachment();
        Seeder::seedScheduleDates();
        Seeder::seedLink();
        $response = $this->getJson('/api/telegram-webapp/v1/post/1');
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
                    "schedule" => [
                        [
                            "id" => 1,
                            "send_planed_date" => "2027-01-01 00:00:00",
                        ]
                    ],
                    'links' => [
                        [
                            'id' => 1,
                            'title' => 'link',
                            'url' => 'https://link.com',
                        ]
                    ],
                    'channels' => [
                        [
                            'id' => 1,
                            'name' => 'channelName',
                            'resource' => [
                                "id" => 1,
                                'name' => 'telegram'
                            ],
                        ]
                    ],
                    'attachments' => [
                        [
                            'id' => 1,
                            'name' => 'name',
                            'url' => '/path1',
                        ]
                    ]
                ]
            ]);
    }

    public function test_store(): void
    {
        Seeder::seedUser();

        $response = $this->postJson('/api/telegram-webapp/v1/post',
            [
                "creator_id" => 1,
                "title" => 'title',
                "text" => 'text',
            ]);
        $response->assertStatus(201)
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

    public function test_update(): void
    {
        Seeder::seedUser();
        Seeder::seedPost();

        $response = $this->putJson('/api/telegram-webapp/v1/post/1',
            [
                "title" => 'title_updated',
                "text" => 'text_updated',
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
                    "title" => "title_updated",
                    "text" => "text_updated",
                    "status" => "created",
                    "schedule" => [],
                    'links' => [],
                    'channels' => []
                ]
            ]);
    }

    public function test_delete(): void
    {
        Seeder::seedUser();
        Seeder::seedClientChannel();
        Seeder::seedPost();
        $response = $this->deleteJson('/api/telegram-webapp/v1/post/1');
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
