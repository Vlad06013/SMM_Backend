<?php

namespace Service;

use App\Domain\Services\Attachment\AttachmentService;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Domain\Services\Post\PostService;
use App\Domain\Services\User\DTO\CreateUserDto;
use App\Domain\Services\User\UserService;
use App\Models\File\AttachmentFile;
use App\Models\Post\Post;
use App\Models\Post\PostHasAttachment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();

       $this->seedPost($createdUser);
        $this->assertDatabaseHas('posts',[
            'id' => 1,
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
            'post_id' => 1,
            'attachment_id' => 1,
        ]);

    }

//    /**
//     * Обновление пользователя
//     *
//     * @return void
//     */
//    public function test_update(): void
//    {
//        $userService = app(UserService::class);
//
//        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();
//
//        $createdUser->name = 'updated_name';
//        $createdUser->telegram_id = 'updated_telegram_id';
//        $createdUser->login = 'updated_login';
//
//        $updated = $userService->update($createdUser);
//        $this->assertDatabaseHas('users', $updated->toArray());
//    }
//
//    /**
//     * Обновление пользователя
//     *
//     * @return void
//     */
//    public function test_show(): void
//    {
//        $userService = app(UserService::class);
//        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();
//
//        $user = $userService->getById($createdUser->id);
//        $this->assertEquals($createdUser->toArray(), $user->toArray());
//    }
//
//    /**
//     * Список пользователей пользователя
//     *
//     * @return void
//     */
//    public function test_index(): void
//    {
//        $userService = app(UserService::class);
//        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();
//
//        $users = $userService->index();
//        foreach ($users as $user) {
//            $this->assertEquals($createdUser->toArray(), $user->toArray());
//        }
//    }
//
//    /**
//     * Удаление пользователя
//     *
//     * @return void
//     */
//    public function test_delete(): void
//    {
//        $userService = app(UserService::class);
//        ['userDto' => $userDto, 'createdUser' => $createdUser] = $this->seedUser();
//        $user = $userService->delete($createdUser->id);
//
//        $this->assertDatabaseMissing('users', $createdUser->toArray());
//    }

    /**
     * Создание пользователя
     *
     * @return array
     */
    public function seedUser(): array
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

    /**
     * Создание Поста
     *
     * @param User $user
     * @return Post
     */
    public function seedPost(User $user): Post
    {
        $postService = app(PostService::class);
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

        $attachment1 = $attachmentService->create($attachmentModel1);

        $postDto = new CreatePostDto(
            creator_id: $user->id,
            title: 'title',
            text: 'text',
            links: [new PostLinkDto('facebook', 'https://facebook.com')],
            scheduleDates: [Carbon::parse('2025-07-08 12:30')],
            attachmentIds: [$attachment1->id],
            channelIds: [1, 2]
        );
        $createdPost = $postService->create($postDto);

       $createdPost->load('attachments', 'links');

        return $createdPost;
    }
}
