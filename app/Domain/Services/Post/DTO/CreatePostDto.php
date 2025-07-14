<?php

namespace App\Domain\Services\Post\DTO;


/**
 * @property integer $creator_id Ид создателя
 * @property string $title Заголовок
 * @property string $text Текст сообщения
 */
class CreatePostDto
{
    public function __construct(
        public int    $creator_id,
        public string $title,
        public string $text,
    )
    {
    }
}
