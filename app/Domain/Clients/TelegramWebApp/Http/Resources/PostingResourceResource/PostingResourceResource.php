<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\PostingResourceResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer $id Ид
 * @property string $name Имя канала
 */
class PostingResourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
