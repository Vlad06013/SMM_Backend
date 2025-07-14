<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\Link;

use App\Domain\Clients\TelegramWebApp\Http\Resources\PostingResourceResource\PostingResourceResource;
use App\Models\File\AttachmentFile;
use App\Models\Post\Link;
use App\Models\Post\PostChannel;
use App\Models\Post\PostingResource;
use App\Models\Post\PostSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property integer $id Ид
 * @property string $title Заголовок
 * @property string $url Значение
 */
class LinksResource extends JsonResource
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
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}
