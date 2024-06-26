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
                'status' => $uploadedFile->status()->value,
            ]);
    }

    public function findFiltered(?int $id, ?string $name, ?string $status, ?string $createdAt, ?int $page): array
    {
        $query = $this->model->query();

        if ($id !== null) {
            $query->where('id', $id);
        }

        if ($name !== null) {
            $query->where('name', 'like', "%$name%");
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($createdAt !== null) {
            $query->whereDate('created_at', $createdAt);
        }

        /**
         * @var \Illuminate\Pagination\LengthAwarePaginator
         */
        $paginate = $query->paginate(10, ['*'], 'page', $page);

        return $paginate->toArray();
    }
}