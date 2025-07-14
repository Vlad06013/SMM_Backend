<?php

namespace App\Domain\Services\Attachment;

use App\Models\File\AttachmentFile;
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
}
