<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;
use App\Infraestructure\Models\UploadedFile as ModelsUploadedFile;

class EloquentUploadedFileRepository implements UploadedFileRepository
{
    public function store(UploadedFile $uploadedFile): void
    {
        $model = new ModelsUploadedFile;

        $model->name = $uploadedFile->name->value;
        $model->created_at = $uploadedFile->createdAt->value;

        $model->save();
    }
}