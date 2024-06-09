<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;
use App\Domain\ValueObjects\UploadedFileId;
use App\Infraestructure\Models\UploadedFile as ModelsUploadedFile;

class EloquentUploadedFileRepository implements UploadedFileRepository
{
    public function store(UploadedFile $uploadedFile): void
    {
        $model = new ModelsUploadedFile;

        $model->name = $uploadedFile->name->value;
        $model->real_path = $uploadedFile->name->value;
        $model->status = $uploadedFile->status()->value;
        $model->created_at = $uploadedFile->createdAt->value;

        $model->save();

        $uploadedFile->created(new UploadedFileId($model->id));
    }

    public function update(UploadedFile $uploadedFile): void
    {
        ModelsUploadedFile::where('id', $uploadedFile->id()->value)
            ->update([
                'name' => $uploadedFile->name->value,
                'real_path' => $uploadedFile->name->value,
                'status' => $uploadedFile->status()->value,
                'created_at' => $uploadedFile->createdAt->value,
            ]);
    }
}