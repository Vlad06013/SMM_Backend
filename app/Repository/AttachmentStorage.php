<?php

namespace App\Repository;

use App\Models\File\AttachmentFile;
use App\Models\Post\Post;

/**
 * @property string $model
 * @method store(AttachmentFile $model)
 * @method index()
 * @method show(int $id)
 * @method update(AttachmentFile $model)
 * @method destroy(int $id)
 */
final class AttachmentStorage extends CrudStorage
{
    public static ?string $model =  AttachmentFile::class;

}
