<?php

namespace App\Domain\Services\Link;

use App\Domain\Services\Link\DTO\CreateLinkDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Models\Post\Link;
use App\Models\Post\Post;
use App\Repository\LinkStorage;
use Illuminate\Support\Collection;

class LinkService
{
    public function __construct(protected LinkStorage $linkStorage)
    {
    }

    /**
     * Создание ссылки поста
     *
     * @param CreateLinkDto $linkDto
     * @return Link
     */
    public function create(CreateLinkDto $linkDto): Link
    {
        $linkModel = new Link();

        $linkModel->post_id = $linkDto->post_id;
        $linkModel->title = $linkDto->title;
        $linkModel->url = $linkDto->url;

        return $this->linkStorage->store($linkModel);
    }

    /**
     * Синхронизация ссылок поста
     *
     * @param Post $post
     * @param PostLinkDto[] $postLinkDto
     * @return array
     */
    public function syncToPost(Post $post, array $postLinkDto): array
    {
        return $this->linkStorage->syncToPost($post, $postLinkDto);
    }
}
