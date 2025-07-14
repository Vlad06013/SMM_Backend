<?php

namespace App\Domain\Services\Link;

use App\Domain\Services\Link\DTO\CreateLinkDTO;
use App\Models\Post\Link;
use App\Repository\LinkStorage;

class LinkService
{
    public function __construct(protected LinkStorage $linkStorage)
    {
    }

    /**
     * Удаление ссылки поста
     *
     * @param int $linkId
     * @return Link
     */
    public function delete(int $linkId): Link
    {
        return $this->linkStorage->destroy($linkId);
    }

    /**
     * Создание ссылки поста
     *
     * @param CreateLinkDTO $linkDto
     * @return Link
     */
    public function create(CreateLinkDTO $linkDto): Link
    {
        $linkModel = new Link();
        $linkModel->post_id = $linkDto->post_id;
        $linkModel->title = $linkDto->title;
        $linkModel->url = $linkDto->url;

        return $this->linkStorage->store($linkModel);
    }
}
