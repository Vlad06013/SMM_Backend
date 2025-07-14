<?php

namespace API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class PostLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_store(): void
    {
        Seeder::seedUser();
        Seeder::seedPost();
        $response = $this->postJson('/api/telegram-webapp/v1/post/1/link',
            [
                "links" => [
                   [
                       'title' => "Test Title",
                       'url' => "https://example.com/test",
                   ],
                    [
                        'title' => "Test Title2",
                        'url' => "https://example2.com/test",
                    ]
                ],
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
                    'links' => [
                        [
                            'id' => 1,
                            'title' => "Test Title",
                            'url' => "https://example.com/test",
                        ],
                        [
                            'id' => 2,
                            'title' => "Test Title2",
                            'url' => "https://example2.com/test",
                        ]
                    ],
                    'channels' => []
                ]
            ]);
    }

    public function test_delete(): void
    {
        Seeder::seedUser();
        Seeder::seedClientChannel();
        Seeder::seedPost();
        Seeder::seedLink();
        $response = $this->deleteJson('/api/telegram-webapp/v1/post/1/link/1');
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
