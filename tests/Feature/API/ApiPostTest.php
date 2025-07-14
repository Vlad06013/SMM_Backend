<?php

namespace API;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ApiPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel();
        $post = Seeder::seedPost(scheduleDates: [Carbon::parse('2026-11-01 12:30')]);
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
                                "send_planed_date" => "2026-11-01 12:30:00",
                            ]
                        ],
                    ]
                ]
            ]);
    }

    public function test_show(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel();
        $post = Seeder::seedPost(
            links: [
                ['title' => 'facebook', 'url' => 'https://facebook.com']
        ],
            scheduleDates: [Carbon::parse('2026-11-01 12:30')],
            attachmentIds: [1],
            channelIds: [1]
        );
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
                            "send_planed_date" => "2026-11-01 12:30:00",
                        ]
                    ],
                    'links' => [
                        [
                            'id' => 1,
                            'title' => 'facebook',
                            'url' => 'https://facebook.com',
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
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel();
        Seeder::seedAttachment();

        $response = $this->postJson('/api/telegram-webapp/v1/post',
            [
                "creator_id" => 1,
                "title" => 'title',
                "text" => 'text',
                "links" => [
                    [
                        'title' => 'facebook',
                        'url' => 'https://facebook.com',
                    ]
                ],
                "scheduleDates" => [
                    '2026-11-01 12:30',
                    '2026-10-11 12:30',
                ],
                'channelIds' => [1],
                'attachmentIds' => [1],
            ]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "creator" => [
                        'id' => $user->id,
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
                            "send_planed_date" => "2026-11-01 12:30:00",
                        ]
                    ],
                    'links' => [
                        [
                            'id' => 1,
                            'title' => 'facebook',
                            'url' => 'https://facebook.com',
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
                    ]
                ]
            ]);
    }


    public function test_delete(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel();
        $post = Seeder::seedPost(
            links:[
                ['title' => 'facebook', 'url' => 'https://facebook.com']
            ],
            scheduleDates: [Carbon::parse('2026-11-01 12:30')],
            channelIds: [1]
        );
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
