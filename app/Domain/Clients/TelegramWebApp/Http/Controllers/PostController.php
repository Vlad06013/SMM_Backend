<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\PostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\DeletePost;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\PostsByUserId;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\ShowPost;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\StorePost;
use App\Domain\Services\Post\DTO\CreatePostDto;
use App\Domain\Services\Post\DTO\PostLinkDto;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = $request->validate([
            'userId' => 'required|integer|exists:users,id',
        ]);
        return app(PostsByUserId::class)($data['userId']);
    }

    /**
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request): PostResource
    {
        $data = $request->validated();

        $createPostDto = new CreatePostDto(
            $data['creator_id'],
            $data['title'],
            $data['text'],
            $data['links'] ? array_map(function ($link) {
                return new PostLinkDto(...$link);
            }, $data['links']) : [],
            $data['scheduleDates'] ? array_map(function ($date) {
                return Carbon::parse($date);
            }, $data['scheduleDates']) : [],
            $data['attachmentIds'] ?? [],
            $data['channelIds'] ?? [],
        );

        return app(StorePost::class)($createPostDto);
    }

    /**
     * @param string $id
     * @return PostResource
     */
    public function show(string $id): PostResource
    {
        return app(ShowPost::class)($id);
    }

    /**
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * @param string $id
     * @return PostResource
     */
    public function destroy(string $id): PostResource
    {
        return app(DeletePost::class)($id);
    }
}
