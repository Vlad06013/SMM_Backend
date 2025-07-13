<?php

namespace App\Domain\Services\Link;

use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Models\Post\Post;
use App\Repository\LinkStorage;
use Illuminate\Support\Str;

class LinkService
{
    public function __construct(protected LinkStorage $linkStorage)
    {
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
        foreach ($postLinkDto as $linkDto) {
            if (!Str::isUrl($linkDto->url))
                throw new \DomainException('"'. $linkDto->url. '" Не является URL');
        }

        return $this->linkStorage->syncToPost($post, $postLinkDto);
    }
}
