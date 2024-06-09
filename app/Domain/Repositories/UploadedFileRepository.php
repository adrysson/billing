<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UploadedFile;

interface UploadedFileRepository
{
    public function store(UploadedFile $uploadedFile): void;

    public function update(UploadedFile $uploadedFile): void;

    public function findFiltered(?int $id, ?string $name, ?string $status, ?string $createdAt, ?int $page): array;
}
