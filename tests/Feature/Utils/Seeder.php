<?php

namespace Tests\Feature\Utils;

use App\Domain\Services\Attachment\AttachmentService;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\ClientChannel\DTO\CreateClientChannelDto;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use App\Models\Channels\ClientChannel;
use App\Models\File\AttachmentFile;
use App\Models\Post\PostingResource;
use Tests\TestCase;

class Seeder extends TestCase
{
    public static function seedPostingResource(): PostingResource
    {
        PostingResource::unguard();

        return PostingResource::create([
            'id' => 1,
            'name' => 'telegram'
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

    public static function seedClientChannel(): ClientChannel
    {
        $clientChannelService = app(ClientChannelService::class);
        $clientChannelDto = new CreateClientChannelDto(
            posting_resources_id: 1,
            name: 'channelName',
            auto_signature: true,
            auto_punctuation: true,
        );

        return $clientChannelService->create($clientChannelDto);
    }

    public static function seedUser(): array
    {
        $userService = app(UserService::class);

        $userDto = new CreateUserDto(
            name: 'test',
            telegram_id: '111',
            login: '111',
        );
        $createdUser = $userService->create($userDto);

        return compact('userDto', 'createdUser');
    }
}
