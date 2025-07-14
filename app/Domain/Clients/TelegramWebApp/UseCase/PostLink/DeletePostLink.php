<?php

namespace App\Domain\Clients\TelegramWebApp\UseCase\PostLink;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Services\Link\LinkService;
use App\Repository\PostStorage;

class DeletePostLink
{
    public function __construct(protected LinkService $linkService)
    {
    }

    public function __invoke(int $postId, int $linkId): PostResource
    {
        $this->linkService->delete($linkId);
        return new PostResource(app(PostStorage::class)->show($postId));
    }
}
