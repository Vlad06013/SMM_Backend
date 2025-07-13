<?php

namespace Service;

use App\Domain\Services\Post\DTO\PostLinkDto;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Utils\Seeder;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Создание пользователя с балансом
     *
     * @return void
     */
    public function test_create(): void
    {
        [
            'resource' => $resource,
            'user' => $user,
            'attachment' => $attachment,
            'channel' => $channel,
            'post' => $post
        ] = $this->seedData();

        $this->assertDatabaseHas('posts', [
            'title' => 'title',
            'text' => 'text',
            'status' => 'created',
        ]);

        $this->assertDatabaseHas('links', [
            'id' => 1,
            'title' => 'facebook',
            'url' => 'https://facebook.com',
        ]);

        $this->assertDatabaseHas('post_has_attachments', [
            'post_id' => $post->id,
            'attachment_id' => $attachment->id,
        ]);

        $this->assertDatabaseHas('post_schedules', [
            'post_id' => $post->id,
            'send_planed_date' => "2025-07-08 12:30",
        ]);

        $this->assertDatabaseHas('post_channels', [
            'post_id' => $post->id,
            'channel_id' => $channel->id,
        ]);
    }


    public function seedData(): array
    {
        $resource = Seeder::seedPostingResource();
        $user = Seeder::seedUser();
        $attachment = Seeder::seedAttachment();
        $channel = Seeder::seedClientChannel($user->id, $resource->id);

        $post = Seeder::seedPost(
            $user->id,
            'title',
            'text',
            [new PostLinkDto('facebook', 'https://facebook.com')],
            [Carbon::parse('2025-07-08 12:30')],
            [$attachment->id],
            [$channel->id],
        );

        return compact('resource', 'user', 'attachment', 'channel', 'post');
    }
}
