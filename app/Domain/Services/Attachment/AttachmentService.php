<?php

namespace App\Domain\Services\Attachment;

use App\Models\File\AttachmentFile;
use App\Models\Post\Post;
use App\Repository\AttachmentStorage;

class AttachmentService
{
    public function __construct(protected AttachmentStorage $attachmentStorage)
    {
    }

    /**
     * @param AttachmentFile $model
     * @return AttachmentFile
     */
    public function create(AttachmentFile $model): AttachmentFile
    {
        return $this->attachmentStorage->store($model);
    }

    /**
     * Синхронизация вложений поста
     *
     * @param Post $post
     * @param array $attachmentsIds
     * @return array
     */
    public function syncToPost(Post $post, array $attachmentsIds): array
    {
        return $this->attachmentStorage->syncToPost($post, $attachmentsIds);
    }
}
