<?php

namespace App\Repository;

use App\Models\Post\Post;
use App\Models\Post\PostSchedule;
use Carbon\Carbon;

/**
 * @property string $model
 * @method store(PostSchedule $model)
 * @method index()
 * @method show(int $id)
 * @method update(PostSchedule $model)
 * @method destroy(int $id)
 */
final class PostScheduleStorage extends CrudStorage
{
    public static ?string $model =  PostSchedule::class;

    /**
     * Синхронизация ссылок поста
     *
     * @param Post $post
     * @param Carbon[] $dates
     * @return array
     */
    public function syncToPost(Post $post, array $dates): array
    {
        return $post->schedule()->sync(array_map(function ($date){
            return ['send_planed_date'=>$date];
        }, $dates));
    }
}
