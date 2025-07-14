<?php

namespace App\Domain\Services\Post\DTO;


/**
 * @property integer $id Ид поста
 * @property string|null $title Заголовок
 * @property string|null $text Текст сообщения
 */
class UpdatePostDto
{
    public function __construct(
        public int     $id,
        public ?string $title = null,
        public ?string $text = null,
    )
    {
    }
}
