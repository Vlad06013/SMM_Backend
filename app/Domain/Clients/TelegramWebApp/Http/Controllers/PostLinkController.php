<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Controllers;

use App\Domain\Clients\TelegramWebApp\Http\Requests\UpdatePostRequest;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Post\PostResource;
use App\Domain\Clients\TelegramWebApp\UseCase\PostLink\DeletePostLink;
use App\Domain\Clients\TelegramWebApp\UseCase\PostLink\StorePostLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
     * @throws ValidationException
     */
    public function store(Request $request, string $post_id): PostResource
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'links' => $request->get('links')],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'links' => 'array',
                'links.*.title' => 'required|string',
                'links.*.url' => 'required|string',
            ]
        );
        $data = $validator->validate();

        return app(StorePostLink::class)($data['post_id'], $data['links']);
    }


    public function show(string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    public function update(UpdatePostRequest $request, string $id)
    {
        return response()->json('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
    }


    /**
     * @throws ValidationException
     */
    public function destroy(string $post_id, string $id)
    {
        $validator = Validator::make(
            ['post_id' => $post_id, 'link_id' => $id],
            [
                'post_id' => 'required|integer|exists:posts,id',
                'link_id' => 'required|integer|exists:links,id',
            ]
        );
        $data = $validator->validate();

        return app(DeletePostLink::class)($data['post_id'], $data['link_id']);
    }
}
