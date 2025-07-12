<?php

namespace App\Models\Post;

use App\Models\File\AttachmentFile;
use App\Models\Relations\HasManySyncable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->hasManySync(PostSchedule::class);
    }

    /**
     * Ссылки
     *
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasManySync(Link::class);
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

    public function attachments()
    {
        return $this->hasManySync(PostHasAttachment::class);
    }

    /**
     * Каналы поста
     *
     * @return BelongsToMany
     */
    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(PostChannel::class);
    }

    /**
     * Overrides the default Eloquent hasMany relationship to return a HasManySyncable.
     */
    public function hasManySync($related, $foreignKey = null, $localKey = null): HasManySyncable
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return new HasManySyncable(
            $instance->newQuery(), $this, $instance->getTable() . '.' . $foreignKey, $localKey
        );
    }
}
