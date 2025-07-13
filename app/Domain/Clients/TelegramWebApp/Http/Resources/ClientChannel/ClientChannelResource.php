<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel;

use App\Domain\Clients\TelegramWebApp\Http\Resources\PostingResourceResource\PostingResourceResource;
use App\Models\Post\PostingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer $id Ид
 * @property integer $user_id Ид пользователя
 * @property integer $posting_resources_id Ид постинг - ресурса
 * @property string $name Имя канала
 * @property boolean $auto_signature Активность Авто-подписи
 * @property boolean $auto_punctuation Активность Авто-пунктуации
 * @property integer $water_marks_id Ид Водяного знака
 * @property boolean $reposter_id Ид репостера
 * @property PostingResource $postingResource Постинг - ресурс
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class ClientChannelResource extends JsonResource
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
            'auto_signature' => $this->auto_signature,
            'auto_punctuation' => $this->auto_punctuation,
            'water_marks_id' => $this->water_marks_id,
            'reposter_id' => $this->reposter_id,
            'resource' => new PostingResourceResource($this->postingResource)
        ];
    }
}
