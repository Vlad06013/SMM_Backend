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
        $channel = Seeder::seedClientChannel();
        $response = $this->getJson('/api/telegram-webapp/v1/client-channel?userId=1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        "id" => 1,
                        "name" => "channelName",
                        "resource" => [
                            "id" => 1,
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
        $channel = Seeder::seedClientChannel();
        $response = $this->getJson('/api/telegram-webapp/v1/client-channel/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "name" => "channelName",
                    "auto_signature" => false,
                    "auto_punctuation" => false,
                    "water_marks_id" => null,
                    "reposter_id" => null,
                    "resource" => [
                        'id' => 1,
                        'name' => 'telegram',
                    ],
                ]
            ]);
    }

    public function test_store(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $response = $this->postJson('/api/telegram-webapp/v1/client-channel',
            [
                "user_id" => 1,
                "posting_resource_id" => 1,
                "name" => 'myChannel',
                "auto_signature" => true,
                "auto_punctuation" => true,
            ]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "name" => "myChannel",
                    "auto_signature" => true,
                    "auto_punctuation" => true,
                    "water_marks_id" => null,
                    "reposter_id" => null,
                    "resource" => [
                        'id' => 1,
                        'name' => 'telegram',
                    ],
                ]
            ]);
    }


    public function test_delete(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel();
        $response = $this->deleteJson('/api/telegram-webapp/v1/client-channel/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    "id" => 1,
                    "name" => "channelName",
                    "auto_signature" => false,
                    "auto_punctuation" => false,
                    "water_marks_id" => null,
                    "reposter_id" => null,
                    "resource" => [
                        'id' => 1,
                        'name' => 'telegram',
                    ],
                ]
            ]);
    }

}
