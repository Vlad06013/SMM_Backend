<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\Post;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Attachment\AttachmentResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\ClientChannel\ClientChannelsResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Link\LinksResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\Schedule\ScheduleResource;
use App\Domain\Clients\TelegramWebApp\Http\Resources\User\UserResource;
use App\Models\File\AttachmentFile;
use App\Models\Post\Link;
use App\Models\Post\PostChannel;
use App\Models\Post\PostSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property integer $id Ид
 * @property integer $creator_id Ид создателя
 * @property string $title Заголовок
 * @property string $text Текст сообщения
 * @property string $status Статус
 * @property User $creator Создатель
 * @property Collection<PostSchedule> $schedule Расписание
 * @property Collection<Link> $links Ссылки
 * @property Collection<AttachmentFile> $attachments Вложения
 * @property Collection<PostChannel> $channels Каналы
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 * @property string $deleted_at Дата время удаления
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->channels->load('channel');
        $channels = $this->channels->pluck('channel');
        $attachments = $this->attachments->pluck('attachment');

        return [
            'id' => $this->id,
            'creator' => new UserResource($this->creator),
            'title' => $this->title,
            'text' => $this->text,
            'status' => $this->status,
            'schedule' => ScheduleResource::collection($this->schedule),
            'links' => LinksResource::collection($this->links),
            'channels' => ClientChannelsResource::collection($channels),
            'attachments' => AttachmentResource::collection($attachments)
        ];
    }
}
