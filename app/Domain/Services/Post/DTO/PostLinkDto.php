<?php

namespace App\Domain\Services\Post\DTO;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
* @property string $title Заголовок
* @property string $url Значение ссылки
*/
class PostLinkDto
{
    public function __construct(
        public string $title,
        public string $url,
    )
    {
    }
}
