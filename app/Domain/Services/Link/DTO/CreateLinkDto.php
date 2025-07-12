<?php

namespace App\Domain\Services\Link\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
* @property integer $post_id Ид поста
* @property string $title Заголовок
* @property string $url Значение ссылки
*/
class CreateLinkDto
{
    public function __construct(
        public int $post_id,
        public string $title,
        public string $url,
    )
    {
    }
}
