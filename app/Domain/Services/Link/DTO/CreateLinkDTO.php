<?php

namespace App\Domain\Services\Link\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
* @property int $post_id Ид поста
* @property string $title Заголовок
* @property string $url Значение ссылки
*/
class CreateLinkDTO
{
    public function __construct(
        public string $post_id,
        public string $title,
        public string $url,
    )
    {
    }
}
