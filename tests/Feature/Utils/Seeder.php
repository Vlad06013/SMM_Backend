<?php

namespace Tests\Feature\Utils;

use App\Domain\Services\Attachment\AttachmentService;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Domain\Services\Post\PostService;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use App\Models\Channels\ClientChannel;
use App\Models\File\AttachmentFile;
use App\Models\Post\Post;
use App\Models\Post\PostingResource;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class Seeder extends TestCase
{
    public static function seedPostingResource(string $name = 'telegram'): PostingResource
    {
        return PostingResource::create([
            'name' => $name
        ]);

    }

    public static function seedAttachment(): AttachmentFile
    {
        $attachmentService = app(AttachmentService::class);

        $attachmentModel1 = new AttachmentFile();
        $attachmentModel1->name = 'name1';
        $attachmentModel1->original_name = 'original_name1';
        $attachmentModel1->mime = 'mime1';
        $attachmentModel1->extension = 'extension1';
        $attachmentModel1->size = 1;
        $attachmentModel1->path = 'path1';
        $attachmentModel1->description = 'description1';
        $attachmentModel1->alt = 'alt1';
        $attachmentModel1->hash = 'hash1';
        $attachmentModel1->disk = 'disk1';

        return $attachmentService->create($attachmentModel1);

    }

    public static function seedClientChannel(
        int    $user_id = 1,
        int    $posting_resources_id = 1,
        string $name = 'channelName',
        bool   $auto_signature = false,
        bool   $auto_punctuation = false,
    ): ClientChannel
    {
        $clientChannelService = app(ClientChannelService::class);
        $clientChannelDto = new CreateClientChannelDto(
            user_id: $user_id,
            posting_resources_id: $posting_resources_id,
            name: $name,
            auto_signature: $auto_signature,
            auto_punctuation: $auto_punctuation,
        );

        return $clientChannelService->create($clientChannelDto);
    }

    public static function seedUser(string $name = 'test', string $telegram_id = '111', string $login = '111'): User
    {
        $userService = app(UserService::class);

        $userDto = new CreateUserDto(
            name: $name,
            telegram_id: $telegram_id,
            login: $login,
        );
        return $userService->create($userDto);
    }

    /**
     * @param int $userID
     * @param string $title
     * @param string $text
     * @param PostLinkDto[] $links
     * @param Carbon[] $scheduleDates
     * @param array $attachmentIds
     * @param array $channelIds
     * @return Post
     */
    public static function seedPost(
        int    $userID = 1,
        string $title = 'title',
        string $text = 'text',
        array  $links = [],
        array  $scheduleDates = [],
        array  $attachmentIds = [],
        array  $channelIds = [],

    ) : Post
    {
        $postService = app(PostService::class);

        $postDto = new CreatePostDto(
            creator_id: $userID,
            title: $title,
            text: $text,
            links: $links,
            scheduleDates: $scheduleDates,
            attachmentIds: $attachmentIds,
            channelIds: $channelIds
        );
        return $postService->create($postDto);
    }
}
