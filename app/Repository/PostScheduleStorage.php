<?php

namespace App\Repository;

use App\Models\Post\PostSchedule;

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
}
