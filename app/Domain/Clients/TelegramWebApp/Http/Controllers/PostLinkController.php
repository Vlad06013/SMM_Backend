<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\UpdatePostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostLink\DeletePostLink;
use App\Domain\Clients\TelegramWebApp\UseCase\PostLink\StorePostLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostLinkController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @param Request $request
     * @param string $post_id
     * @return PostResource
     */
    public function store(Request $request, string $post_id): PostResource
    {
        $data = $request->validate([
            'links' => 'array',
            'links.*.title' => 'required|string',
            'links.*.url' => 'required|string',
        ]);

        return app(StorePostLink::class)($post_id, $data['links']);
    }


    public function show(string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function update(UpdatePostRequest $request, string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function destroy(string $post_id, string $id)
    {
        return app(DeletePostLink::class)($post_id, $id);
    }
}
