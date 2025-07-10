<?php

namespace App\Models\Channels;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $reposter_id Ид репостера
 * @property string $channel_username Имя канала в телеграм
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class ReposterChannel extends Model
{
    protected $fillable = [
        'reposter_id',
        'channel_username',
    ];

}
