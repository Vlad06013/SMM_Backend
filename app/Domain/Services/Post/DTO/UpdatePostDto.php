<?php

namespace App\Domain\Services\Post\DTO;

use Carbon\Carbon;

/**
* @property integer $id Ид поста
* @property string|null $title Заголовок
* @property string|null $text Текст сообщения
* @property Carbon[]|null $scheduleDates Расписание
* @property PostLinkDto[]|null $links Ссылки
* @property array|null $attachmentIds Ид вложений
* @property array|null $channelIds Ид каналов
*/
class UpdatePostDto
{
    public function __construct(
        public int $id,
        public ?string $title = null,
        public ?string $text = null,
        public ?array $links = null,
        public ?array $scheduleDates = null,
        public ?array $attachmentIds = null,
        public ?array $channelIds = null,
    )
    {
    }
}
