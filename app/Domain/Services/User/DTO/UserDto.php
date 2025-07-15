<?php

namespace App\Domain\Services\User\DTO;

/**
 * @property string $name
 * @property string|null $telegram_id
 * @property string|null $login
 */
class UserDto
{
    public function __construct(
        public string $name,
        public ?string $telegram_id = null,
        public ?string $login  = null,
    )
    {
    }
}
