<?php

namespace App\Domain\Services\User\DTO;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $telegram_id
 * @property string|null $login
 */
class UpdateUserDto
{
    public function __construct(
        public int     $id,
        public ?string $name = null,
        public ?string $telegram_id = null,
        public ?string $login = null,
    )
    {
    }
}
