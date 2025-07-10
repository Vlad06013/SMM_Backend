<?php

namespace App\Domain\Services\User\DTO;

/**
 * @property string $name
 * @property string $telegram_id
 * @property string $login
 */
class CreateUserDto
{
    public function __construct(
        public string $name,
        public string $telegram_id,
        public string $login,
    )
    {
    }
}
