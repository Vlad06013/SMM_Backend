<?php

namespace App\Models\Post;

use App\Models\File\AttachmentFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

/**
 * @property integer $id Ид
 * @property integer $creator_id Ид создателя
 * @property string $title Заголовок
 * @property string $text Текст сообщения
 * @property string $status Статус
 * @property User $creator Создатель
 * @property Collection<PostSchedule> $schedule Расписание
 * @property Collection<Link> $links Ссылки
 * @property Collection<AttachmentFile> $attachments Вложения
 * @property Collection<PostChannel> $channels Каналы
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 * @property string $deleted_at Дата время удаления
 */
class Post extends Model
{
    protected $fillable = [
        'creator_id',
        'title',
        'text',
        'status',
    ];

    /**
     * Создатель
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Расписание
     *
     * @return HasMany
     */
    public function schedule(): HasMany
    {
        return $this->hasMany(PostSchedule::class);
    }

    /**
     * Ссылки
     *
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Вложения
     *
//     * @return HasManyThrough
     */
//    public function attachments(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            AttachmentFile::class,
//            PostHasAttachment::class,
//            'post_id',
//            'id',
//            'id',
//            'attachment_id'
//        );
//    }

    public function attachments(): HasMany
    {
        return $this->hasMany(PostHasAttachment::class);
    }

    /**
     * Каналы поста
     *
     * @return HasMany
     */
    public function channels(): HasMany
    {
        return $this->hasMany(PostChannel::class);
    }
}
