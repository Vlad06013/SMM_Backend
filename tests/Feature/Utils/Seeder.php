<?php

namespace Tests\Feature\Utils;

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
        array  $links = [],
        array  $scheduleDates = [],
        array  $attachmentIds = [],
        array  $channelIds = [],
        int    $postId = 1,

    ): Post
    {
        Post::unguard();
        $post = Post::create([
            'id' => $postId,
            'creator_id' => $userID,
            'title' => $title,
            'text' => $text,
        ]);
        foreach ($links as $link) {
          self::seedLink($post->id, $link['url'], $link['title']);
        }
        foreach ($scheduleDates as $scheduleDate) {
           self::seedScheduleDates($post->id, $scheduleDate);
        }

        foreach ($channelIds as $channelId) {
            self::seedPostChannels($post->id, $channelId);
        }

        foreach ($attachmentIds as $attachmentId) {
            $attachmentCreated = self::seedAttachment(id:$attachmentId);

            PostHasAttachment::create([
                'post_id' => $postId,
                'attachment_id' => $attachmentCreated->id,
            ]);
        }

        return $post;
    }

    public static function seedPostChannels(string $postId, int $channelId, int $id = 1)
    {
        PostSchedule::unguard();

        return PostChannel::create([
            'id' => $id,
            'post_id' => $postId,
            'channel_id' => $channelId,
        ]);
    }

    public static function seedScheduleDates(string $postId, string $date, int $id = 1)
    {
        PostSchedule::unguard();

        return PostSchedule::create([
            'id' => $id,
            'post_id' => $postId,
            'send_planed_date' => $date,
        ]);
    }

    public static function seedLink(string $postId, string $url, string $title, int $id = 1)
    {
        Link::unguard();

        return Link::create([
            'id' => $id,
            'post_id' => $postId,
            'url' => $url,
            'title' => $title,
        ]);
    }
}
