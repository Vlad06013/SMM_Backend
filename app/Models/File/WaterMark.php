<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id Ид
 * @property integer $attachment_id Ид файла
 * @property integer $size Размер в процентах
 * @property boolean $repeatable Повторяющийся
 * @property integer $x_position Процент по горизонтали
 * @property integer $y_position Процент по вертикали
 * @property AttachmentFiles $attachment Файл
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class WaterMark extends Model
{
    protected $fillable = [
        'attachment_id',
        'size',
        'repeatable',
        'x_position',
        'y_position',
    ];

    protected $casts = [
        'repeatable' => 'boolean',
    ];
    /**
     * Файл
     *
     * @return BelongsTo
     */
    public  function attachment(): BelongsTo
    {
        return $this->belongsTo(AttachmentFiles::class,'attachment_id','id');
    }
}
