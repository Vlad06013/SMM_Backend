<?php

namespace Service;

use App\Domain\Services\ClientChannel\ClientChannelService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ClientChannelServiceTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Создание канала пользователя
     *
     * @return void
     */
    public function test_create(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel($user->id, $resource->id);

        $this->assertDatabaseHas('client_channels', [
            'user_id' => $user->id,
            'posting_resource_id' => $resource->id,
            'name' => 'channelName',
            'auto_signature' => false,
            'auto_punctuation' => false,
        ]);
    }

    public function test_getByUserID(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channelCreated = Seeder::seedClientChannel($user->id, $resource->id);

        $channelService = app(ClientChannelService::class);
        $userChannels = $channelService->getByUserId($user->id);
        $channel = $userChannels->first();
        $channelArray = $channel->toArray();
        unset($channelArray['created_at'], $channelArray['updated_at']);
        $this->assertEquals(
            [
                "id" => $channelCreated->id,
                "user_id" => $user->id,
                "posting_resource_id" => $resource->id,
                "name" => 'channelName',
                "auto_signature" => false,
                'auto_punctuation' => false,
                'water_marks_id' => null,
                'reposter_id' => null,
            ],
            $channelArray);

    }

}
