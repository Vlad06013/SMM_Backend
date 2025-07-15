<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostLink;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Link\LinkService;
use App\Repository\PostStorage;

class UpdatePostLink
{
    public function __construct(protected LinkService  $linkService)
    {
    }

    public function __invoke(int $postId, int $linkId, array $link): PostResource
    {
        $this->linkService->update($linkId, $link['title'], $link['url']);

        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
