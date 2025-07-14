<?php

namespace API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ApiPostScheduleTest extends TestCase
{
    use RefreshDatabase;

    public function test_store(): void
    {
        Seeder::seedUser();
        Seeder::seedPost();
        $response = $this->postJson('/api/telegram-webapp/v1/post/1/schedule',
            [
                "scheduleDates" => [
                    "2025-01-01 15:30",
                    "2025-01-02 15:30",
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
                    "schedule" => [
                        [
                            'id' => 1,
                            'send_planed_date' => '2025-01-01 15:30:00',
                        ],
                        [
                            'id' => 2,
                            'send_planed_date' => '2025-01-02 15:30:00',
                        ]
                    ],
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
