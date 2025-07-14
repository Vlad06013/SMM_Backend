<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostLink;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Link\DTO\CreateLinkDTO;
use App\Domain\Services\Link\LinkService;
use App\Repository\PostStorage;

class StorePostLink
{
    public function __construct(protected LinkService $linkService)
    {
    }

    public function __invoke(int $postId, array $links): PostResource
    {
        foreach ($links as $link) {
            $linkDto = new CreateLinkDTO(
                post_id: $postId,
                title: $link['title'],
                url: $link['url'],
            );
            $this->linkService->create($linkDto);
        }
        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
