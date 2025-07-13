<?php

namespace App\Domain\Services\ClientChannel\DTO;

/**
 * @property integer $user_id Ид Пользователя
 * @property integer $posting_resource_id Ид постинг - ресурса
 * * @property string $name Имя канала
 * * @property boolean $auto_signature Активность Авто-подписи
 * * @property boolean $auto_punctuation Активность Авто-пунктуации
 * * @property integer $water_marks_id Ид Водяного знака
 * * @property boolean $reposter_id Ид репостера
 */
class CreateClientChannelDto
{
    public function __construct(
        public int $user_id,
        public int $posting_resource_id,
        public string $name,
        public bool $auto_signature,
        public bool $auto_punctuation,
        public ?int $water_marks_id = null,
        public ?int $reposter_id = null,
    )
    {
    }
}
