<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property string $name Имя
 * @property string $original_name Оригинально имя
 * @property string $mime Mime тип
 * @property string $extension Разрешение
 * @property integer $size Размер
 * @property integer $sort Сортировка
 * @property string $path Путь
 * @property string $description Описание
 * @property string $alt Альтернативное имя
 * @property string $hash Хэш имя
 * @property string $disk Диск
 * @property integer $user_id Ид создателя
 * @property string $group Группа
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class AttachmentFiles extends Model
{
    protected $fillable = [
        'name',
        'original_name',
        'mime',
        'extension',
        'size',
        'sort',
        'path',
        'description',
        'alt',
        'hash',
        'disk',
        'user_id',
        'group',
    ];
}
