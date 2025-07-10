<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $resource_id Ид ресурса микросервиса отправителя
 * @property string $name Название ресурса
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class PostingResource extends Model
{
    protected $fillable = [
        'resource_id',
        'name'
    ];
}
