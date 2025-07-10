<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $post_id Ид поста
 * @property integer $channel_id Ид канала
 * @property string $status_send Статус отправки
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class PostChannel extends Model
{
    protected $fillable = [
        'post_id',
        'channel_id',
        'status_send',
    ];
}
