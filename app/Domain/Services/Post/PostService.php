<?php

namespace App\Domain\Services\Post;

use App\Domain\Services\Attachment\AttachmentService;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\Link\LinkService;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\UpdatePostDto;
use App\Domain\Services\PostSchedule\PostScheduleService;
use App\Domain\Support\Enumerations\Post\PostStatusEnum;
use App\Models\Post\Post;
use App\Repository\PostStorage;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        protected PostStorage          $postStorage,
        protected LinkService          $linkService,
        protected AttachmentService    $attachmentService,
        protected PostScheduleService  $postScheduleService,
        protected ClientChannelService $clientChannelService,
    )
    {
    }

    /**
     * Создание поста
     *
     * @param CreatePostDto $postDto
     * @return Post
     */
    public function create(CreatePostDto $postDto): Post
    {
        $postModel = new Post();
        $postModel->creator_id = $postDto->creator_id;
        $postModel->title = $postDto->title;
        $postModel->text = $postDto->text;
        $postModel->status = PostStatusEnum::CREATED;

        $post = $this->postStorage->store($postModel);

//        $this->linkService->syncToPost($post, $postDto->links);
//        $this->attachmentService->syncToPost($post, $postDto->attachmentIds);
//        $this->postScheduleService->syncToPost($post, $postDto->scheduleDates);
//        $this->clientChannelService->syncToPost($post, $postDto->channelIds);

        return $post;
    }

    /**
     * @param int $id
     * @return Post|null
     */
    public function show(int $id): ?Post
    {
        return $this->postStorage->show($id);
    }

    /**
     * Получение постов пользователя
     *
     * @param int $userId
     * @return Collection<Post>|null
     */
    public function getByUserId(int $userId): ?Collection
    {
        return $this->postStorage->getByUserId($userId);
    }

    /**
     * Удаление поста
     *
     * @param int $postId
     * @return Post
     */
    public function delete(int $postId): Post
    {
        return $this->postStorage->destroy($postId);
    }

    /**
     * Обновление поста
     *
     * @param UpdatePostDto $updatePostDto
     * @return Post
     */
    public function update(UpdatePostDto $updatePostDto): Post
    {
        $postModel = $this->show($updatePostDto->id);

        $postDtoArray = collect($updatePostDto)->filter(function ($value) {
            return !is_null($value);
        })->all();

//        unset(
//            $postDtoArray['links'],
//            $postDtoArray['scheduleDates'],
//            $postDtoArray['attachmentIds'],
//            $postDtoArray['channelIds']
//        );

        $postModel->fill($postDtoArray);
        $this->postStorage->update($postModel);

//        if ($updatePostDto->links)
//            $this->linkService->syncToPost($postModel, $updatePostDto->links);
//
//        if ($updatePostDto->attachmentIds)
//            $this->attachmentService->syncToPost($postModel, $updatePostDto->attachmentIds);
//
//        if ($updatePostDto->scheduleDates)
//            $this->postScheduleService->syncToPost($postModel, $updatePostDto->scheduleDates);
//
//        if ($updatePostDto->channelIds)
//            $this->clientChannelService->syncToPost($postModel, $updatePostDto->channelIds);

        return $postModel->fresh();
    }
}
