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



    /**
     * Синхронизация вложений поста
     *
     * @param Post $post
     * @param array $postAttachmentIds
     * @return array
     */
    public function syncToPost(Post $post, array $postAttachmentIds): array
    {
        return $post->attachments()->sync(array_map(function ($postAttachmentId){
            return ['attachment_id' =>$postAttachmentId];
        }, $postAttachmentIds));
    }
}
