<?php

namespace App\Domain\Services\Post;

use App\Domain\Services\Attachment\AttachmentService;
use App\Domain\Services\ClientChannel\ClientChannelService;
use App\Domain\Services\Link\LinkService;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\PostSchedule\PostScheduleService;
use App\Domain\Support\Enumerations\Post\PostStatusEnum;
use App\Models\Post\Post;
use App\Repository\PostStorage;

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

        $this->linkService->syncToPost($post, $postDto->links);
        $this->attachmentService->syncToPost($post, $postDto->attachmentIds);
        $this->postScheduleService->syncToPost($post, $postDto->scheduleDates);
        $this->clientChannelService->syncToPost($post, $postDto->channelIds);

        return $post;
    }
}
