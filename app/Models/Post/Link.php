<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $post_id Ид Поста
 * @property string $title Заголовок
 * @property string $url Значение ссылки
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class Link extends Model
{
    protected $fillable = [
        'post_id',
        'title',
        'url',
    ];
}
