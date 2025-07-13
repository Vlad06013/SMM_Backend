<?php

namespace Service;

use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Domain\Services\Post\PostService;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use App\Models\Post\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class ClientChannelServiceTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Создание пользователя с балансом
     *
     * @return void
     */
    public function test_create(): void
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $channel = Seeder::seedClientChannel($user->id);


        $this->assertDatabaseHas('client_channels', [
            'user_id' => $user->id,
            'posting_resources_id' => $resource->id,
            'name' => 'channelName',
            'auto_signature' => false,
            'auto_punctuation' => false,
        ]);
    }

}
