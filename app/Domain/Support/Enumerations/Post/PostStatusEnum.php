<?php

namespace App\Domain\Support\Enumerations\Post;

enum PostStatusEnum: string
{
    case CREATED = 'created';
    case CONFIRMED = 'confirmed';
    case PLANED = 'planed';
    case SANDED = 'sanded';
    case ERROR = 'error';
    case CANCELLED = 'cancelled';
}
