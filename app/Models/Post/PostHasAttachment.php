<?php

namespace App\Models\Post;

use App\Models\File\AttachmentFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id Ид
 * @property integer $post_id Ид поста
 * @property integer $attachment_id Ид канала
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class PostHasAttachment extends Model
{
    protected $fillable = [
        'post_id',
        'attachment_id',
    ];

    protected $with = [
        'attachment',
    ];
    public function attachment(): BelongsTo
    {
        return $this->belongsTo(AttachmentFile::class, 'attachment_id');
    }
}
