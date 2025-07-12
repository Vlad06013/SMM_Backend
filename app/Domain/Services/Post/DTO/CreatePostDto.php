<?php

namespace App\Domain\Services\Post\DTO;

use Carbon\Carbon;

/**
* @property integer $creator_id Ид создателя
* @property string $title Заголовок
* @property string $text Текст сообщения
* @property Carbon[] $schedule Расписание
* @property PostLinkDto[] $links Ссылки
* @property array $attachmentIds Ид вложений
* @property array $channelIds Ид каналов
*/
class CreatePostDto
{
    public function __construct(
        public int $creator_id,
        public string $title,
        public string $text,
        public array $links,
        public array $scheduleDates,
        public array $attachmentIds,
        public array $channelIds,
    )
    {
    }
}
