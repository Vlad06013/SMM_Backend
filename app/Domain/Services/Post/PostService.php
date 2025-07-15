<?php

namespace App\Domain\Services\Post;

use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\UpdatePostDto;
use App\Domain\Support\Enumerations\Post\PostStatusEnum;
use App\Models\Post\Post;
use App\Repository\PostStorage;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        protected PostStorage          $postStorage,
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

        return $this->postStorage->store($postModel);
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

        $postModel->fill($postDtoArray);
        $this->postStorage->update($postModel);

        return $postModel->fresh();
    }
}
