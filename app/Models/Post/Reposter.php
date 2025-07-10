<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property boolean $advertising_post_active Обработка рекламных постов
 * @property boolean $post_schedule_active Постинг по расписанию
 * @property boolean $make_rewrite Рерайт текста поста
 * @property boolean $add_watermark Добавление водяных знаков
 * @property boolean $auto_signature_active Добавление авто-подписи
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class Reposter extends Model
{
    protected $fillable = [
        'advertising_post_active',
        'post_schedule_active',
        'make_rewrite',
        'add_watermark',
        'auto_signature_active',
    ];

    protected $casts  = [
        'advertising_post_active' => 'boolean',
        'post_schedule_active' => 'boolean',
        'make_rewrite' => 'boolean',
        'add_watermark' => 'boolean',
        'auto_signature_active' => 'boolean',
    ];
}
