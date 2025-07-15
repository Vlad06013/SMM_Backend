<?php

namespace Database\Seeders\Utils;

use App\Models\BalanceAccount\BalanceAccount;
use App\Models\Channels\ClientChannel;
use App\Models\File\AttachmentFile;
use App\Models\Post\Link;
use App\Models\Post\Post;
use App\Models\Post\PostChannel;
use App\Models\Post\PostHasAttachment;
use App\Models\Post\PostingResource;
use App\Models\Post\PostSchedule;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class Seeder extends TestCase
{

    public static function seedPostingResource(string $name = 'telegram', int $id = 1): PostingResource
    {
        PostingResource::unguard();
        return PostingResource::create([
            'id' => $id,
            'name' => $name
        ]);

    }

    public static function seedAttachment(string $name = 'name', int $id = 1): AttachmentFile
    {
        AttachmentFile::unguard();

        return AttachmentFile::create([
            'id' => $id,
            'name' => $name,
            'original_name' => $name,
            'mime' => 'image',
            'extension' => 'jpeg',
            'size' => 1,
            'path' => '/path1',
            'description' => 'description',
            'alt' => 'alt',
            'hash' => 'hash',
            'disk' => 'public',
        ]);
    }

    public static function seedClientChannel(
        int    $user_id = 1,
        int    $posting_resource_id = 1,
        string $name = 'channelName',
        bool   $auto_signature = false,
        bool   $auto_punctuation = false,
        ?int   $reposter_id = null,
        int    $id = 1,
    ): ClientChannel
    {
        ClientChannel::unguard();

        return ClientChannel::create([
            'id' => $id,
            'user_id' => $user_id,
            'posting_resource_id' => $posting_resource_id,
            'name' => $name,
            'auto_signature' => $auto_signature,
            'auto_punctuation' => $auto_punctuation,
            'reposter_id' => $reposter_id,
        ]);

    }

    public static function seedUser(string $name = 'test', string $telegram_id = '111', string $login = '111', int $id = 1): User
    {
        User::unguard();

        $balance = self::seedBalanceAccount();

        return User::create([
            'id' => $id,
            'name' => $name,
            'login' => $login,
            'telegram_id' => $telegram_id,
            'balance_id' => $balance->id,
        ]);
    }

    public static function seedBalanceAccount($value = 0, int $id = 1)
    {
        BalanceAccount::unguard();

        return BalanceAccount::create([
            'id' => $id,
            'value' => $value
        ]);
    }

    public static function seedPost(
        int    $userID = 1,
        string $title = 'title',
        string $text = 'text',
        int    $postId = 1,

    ): Post
    {
        Post::unguard();
        return Post::create([
            'id' => $postId,
            'creator_id' => $userID,
            'title' => $title,
            'text' => $text,
        ]);

    }

    public static function seedPostChannels(int $postId = 1, int $channelId = 1, int $id = 1)
    {
        PostChannel::unguard();

        return PostChannel::create([
            'id' => $id,
            'post_id' => $postId,
            'channel_id' => $channelId,
        ]);
    }

    public static function seedScheduleDates(int $postId = 1, string $date = '2027-01-01', int $id = 1)
    {
        PostSchedule::unguard();

        return PostSchedule::create([
            'id' => $id,
            'post_id' => $postId,
            'send_planed_date' => Carbon::parse($date),
        ]);
    }

    public static function seedLink(int $postId = 1, string $url = 'https://link.com', string $title = 'link', int $id = 1)
    {
        Link::unguard();

        return Link::create([
            'id' => $id,
            'post_id' => $postId,
            'url' => $url,
            'title' => $title,
        ]);
    }

    public static function seedPostChannel(int $postId = 1, int $channelId = 1, int $id = 1)
    {
        PostChannel::unguard();

        return PostChannel::create([
            'id' => $id,
            'post_id' => $postId,
            'channel_id' => $channelId,
        ]);
    }

    public static function seedPostAttachment(int $postId = 1, int $attachmentId = 1, int $id = 1)
    {
        PostHasAttachment::unguard();

        return PostHasAttachment::create([
            'id' => $id,
            'post_id' => $postId,
            'attachment_id' => $attachmentId,
        ]);
    }
}
