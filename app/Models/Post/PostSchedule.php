<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $post_id Ид поста
 * @property string $send_planed_date Запланированная дата время отправки
 * @property string $send_actual_date Фактическая дата время размещение поста
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class PostSchedule extends Model
{
    protected $fillable = [
        'post_id',
        'send_planed_date',
        'send_actual_date',
    ];
    protected $casts  = [
        'send_planed_date' => 'datetime',
        'send_actual_date' => 'datetime',
    ];
}
