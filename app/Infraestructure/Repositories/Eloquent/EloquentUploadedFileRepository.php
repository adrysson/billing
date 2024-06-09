<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;
use App\Domain\ValueObjects\UploadedFileId;
use App\Infraestructure\Models\UploadedFile as ModelsUploadedFile;

class EloquentUploadedFileRepository implements UploadedFileRepository
{
    public function __construct(private ModelsUploadedFile $model)
    {
    }

    public function store(UploadedFile $uploadedFile): void
    {
        $model = $this->model->newInstance();

        $model->name = $uploadedFile->name->value;
        $model->real_path = $uploadedFile->realPath->value;
        $model->status = $uploadedFile->status()->value;
        $model->created_at = $uploadedFile->createdAt->value;

        $model->save();

        $uploadedFile->created(new UploadedFileId($model->id));
    }

    public function update(UploadedFile $uploadedFile): void
    {
        $this->model->where('id', $uploadedFile->id()->value)
            ->update([
                'name' => $uploadedFile->name->value,
                'real_path' => $uploadedFile->realPath->value,
                'status' => $uploadedFile->status()->value,
                'created_at' => $uploadedFile->createdAt->value,
            ]);
    }
}