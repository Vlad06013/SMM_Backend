<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\CreatePostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Requests\UpdatePostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\DeletePost;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\PostsByUserId;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\ShowPost;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\StorePost;
use App\Domain\Clients\TelegramWebApp\UseCase\Post\UpdatePost;
use App\Http\Controllers\Controller;
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
     * @param CreatePostRequest $request
     * @return PostResource
     */
    public function store(CreatePostRequest $request): PostResource
    {
        $data = $request->validated();

        return app(StorePost::class)($data);
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
     * @param UpdatePostRequest $request
     * @param string $id
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, string $id): PostResource
    {
        $data = $request->validated();
        $data['id'] = $id;

        return app(UpdatePost::class)($data);

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
