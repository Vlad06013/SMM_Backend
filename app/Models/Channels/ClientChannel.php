<?php

namespace App\Models\Channels;

use App\Models\File\WaterMark;
use App\Models\Post\PostingResource;
use App\Models\Post\Reposter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id Ид
 * @property integer $user_id Ид пользователя
 * @property integer $posting_resources_id Ид постинг - ресурса
 * @property string $name Имя канала
 * @property boolean $auto_signature Активность Авто-подписи
 * @property boolean $auto_punctuation Активность Авто-пунктуации
 * @property integer $water_marks_id Ид Водяного знака
 * @property boolean $reposter_id Ид репостера
 * @property PostingResource $postingResources Постинг - ресурс
 * @property WaterMark $waterMark Водяной знак
 * @property Reposter $reposter Репостер
 * @property User $user Пользователь
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class ClientChannel extends Model
{
    protected $fillable = [
        'user_id',
        'posting_resources_id',
        'name',
        'auto_signature',
        'auto_punctuation',
        'water_marks_id',
        'reposter_id',
    ];

    protected $casts = [
        'auto_signature' => 'boolean',
        'auto_punctuation' => 'boolean',
    ];

    /**
     * Пользователь
     *
     * @return BelongsTo
     */
    public  function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    /**
     * Ресурс постинга
     *
     * @return HasOne
     */
    public  function postingResources(): HasOne
    {
        return $this->hasOne(PostingResource::class);
    }

    /**
     * Водяной знак
     *
     * @return HasOne
     */
    public  function waterMark(): HasOne
    {
        return $this->hasOne(WaterMark::class);
    }

    /**
     * Репостер
     *
     * @return HasOne
     */
    public  function reposter(): HasOne
    {
        return $this->hasOne(Reposter::class);
    }
}
